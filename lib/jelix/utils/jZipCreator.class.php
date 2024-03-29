<?php
/**
 * @package    jelix
 * @subpackage utils
 * @author     Laurent Jouanneau
 * @copyright  2006 Laurent Jouanneau
 * @link       http://www.jelix.org
 * @licence    GNU Lesser General Public Licence see LICENCE file or http://www.gnu.org/licenses/lgpl.html
 */

/**
 * Class to create a zip file.
 * @package    jelix
 * @subpackage utils
 * @link http://www.pkware.com/business_and_developers/developer/appnote/ Official ZIP file format
 */
class jZipCreator {

    /**
     * contains all file records
     * @var  array $fileRecords
     */
    protected $fileRecords = array();

    /**
     * Contains the central directory
     * @var  array $centralDirectory
     */
    protected $centralDirectory = array();

    /**
     * Offset of the central directory
     * @var  integer  $centralDirOffset
     */
    protected $centralDirOffset   = 0;

    /**
     * adds a physical file to the zip archive
     *
     * @param  string  $filename  the path of the physical file you want to add
     * @param  string  $zipPath  the path of the file inside the zip archive
     */
    public function addFile($filename, $zipFileName=''){
        if($zipFileName == '') $zipFileName = $filename;
        if(file_exists($filename)){
            $this->addContentFile($zipFileName, file_get_contents($filename), filemtime($filename));
        }else{
            throw new jException('jelix~errors.file.notexists', $filename);
        }
    }

    /**
     * adds the content of a directory to the zip archive
     *
     * @param  string  $path  the path of the physical directory you want to add
     */
    public function addDir($path, $zipDirPath='', $recursive = false){
        if(file_exists($path)){
            if($zipDirPath !='' && substr($zipDirPath,-1,1) != '/')
                $zipDirPath.='/';
            if(substr($path,-1,1) != '/')
                $path.='/';

            if ($handle = opendir($path)) {
                while (($file = readdir($handle)) !== false) {
                    if($file == "." || $file == "..") continue;
                    if (!is_dir($path.$file)) {
                        $this->addFile($path.$file, $zipDirPath.$file);
                    }elseif ($recursive){
                        $this->addDir($path.$file,$zipDirPath.$file, true);
                    }
                }
                closedir($handle);
            }
        }else{
            throw new jException('jelix~errors.file.notexists', $path);
        }
    }

    /**
     * add a "logical" file to the zip archive
     *
     * @param  string   $zipFileName    the path of the file into the zip archive
     * @param  string   $content    the content of the file
     * @param  integer  $filetime   the time modification of the file
     */
    public function addContentFile($zipFileName, $content, $filetime = 0){

        // converts unix timestamp to dos binary format
        if($filetime == 0)
            $filetime = mktime();
        elseif($filetime < 315529200) // 01/01/1980
            $filetime = 315529200;

        $dt = getdate($filetime);

        $filetime =  pack('V',($dt['seconds'] >> 1) | ($dt['minutes'] << 5) | ($dt['hours'] << 11) |
                ($dt['mday'] << 16) | ($dt['mon'] << 21) | (($dt['year'] - 1980) << 25));

        /*
        generation of the file record

        file record:
         - local file header signature     4 bytes  (0x04034b50)
         - version needed to extract       2 bytes  14
         - general purpose bit flag        2 bytes  0
         - compression method              2 bytes  0x8
         - last mod file time              2 bytes (fileinfo)
         - last mod file date              2 bytes (fileinfo)
         - crc-32                          4 bytes (fileinfo)
         - compressed size                 4 bytes (fileinfo)
         - uncompressed size               4 bytes (fileinfo)
         - file name length                2 bytes (fileinfo)
         - extra field length              2 bytes (here 0) (fileinfo)
         - file name (variable size)
         - extra field (variable size)      (here nothing)
         - compressed content
        */
        $zipFileName     = str_replace('\\', '/', $zipFileName);

        $zippedcontent    = substr(gzcompress($content), 2, -4); // compress and fix crc bug

        $fileinfo  = $filetime.pack('V', crc32($content));
        $fileinfo .= pack('V', strlen($zippedcontent)). pack('V', strlen($content));
        $fileinfo .= pack('v', strlen($zipFileName))."\x00\x00";

        $filerecord   = "\x50\x4b\x03\x04\x14\x00\x00\x00\x08\x00";
        $filerecord .= $fileinfo.$zipFileName.$zippedcontent;

        $this->fileRecords[] = $filerecord;


        /*
         register the file into the central directory record
         it contains an header for each file
           - central file header signature   4 bytes  (0x02014b50)
           - version made by                 2 bytes  0=DOS
           - version needed to extract       2 bytes  0x14
           - general purpose bit flag        2 bytes  0
           - compression method              2 bytes  0x8
           - last mod file time              2 bytes (fileinfo)
           - last mod file date              2 bytes (fileinfo)
           - crc-32                          4 bytes (fileinfo)
           - compressed size                 4 bytes (fileinfo)
           - uncompressed size               4 bytes (fileinfo)
           - file name length                2 bytes (fileinfo)
           - extra field length              2 bytes   0 (fileinfo)
           - file comment length             2 bytes   0
           - disk number start               2 bytes   0
           - internal file attributes        2 bytes   0
           - external file attributes        4 bytes   32 : 'archive' bit set
           - relative offset of local header 4 bytes
           - file name (variable size)
           - extra field (variable size)
           - file comment (variable size)
        */
        $cdrecord = "\x50\x4b\x01\x02\x00\x00\x14\x00\x00\x00\x08\x00".$fileinfo;
        $cdrecord .= "\x00\x00\x00\x00\x00\x00\x32\x00\x00\x00";
        $cdrecord .= pack('V', $this ->centralDirOffset );
        $cdrecord .= $zipFileName;

        $this->centralDirectory[] = $cdrecord;

        $this ->centralDirOffset += strlen($filerecord);

    }


    /**
     * create the contenu of the zip file
     * @return  string  the content of the zip file
     */
    public function getContent(){

        $centraldir = implode('', $this->centralDirectory);
        $c = pack('v', count($this ->centralDirectory));

        /*
        zip file :
           - file records
           - central dir
           - end of central dir signature    4 bytes  (0x06054b50)
           - number of this disk             2 bytes   (0 here)
           - number of the disk with the
              start of the central directory 2 bytes   (0 here)
           - total number of entries in the
              central directory on this disk 2 bytes
           - total number of entries in
              the central directory          2 bytes
           - size of the central directory   4 bytes
           - offset of start of central directory with respect to
             the starting disk number        4 bytes
           - .ZIP file comment length        2 bytes
           - .ZIP file comment       (variable size)
        */
        return implode('', $this->fileRecords).$centraldir."\x50\x4b\x05\x06\x00\x00\x00\x00".$c.$c.
            pack('V', strlen($centraldir)).pack('V', $this ->centralDirOffset)."\x00\x00";
    }
}

?>