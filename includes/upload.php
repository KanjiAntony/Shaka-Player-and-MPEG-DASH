<?php
//require_once ('functions.php');
//replace with this below
require_once("initialise.php");
//this class will help with the uploading of files
//uploaded images will be sent to the uploaded/images
//videos in the uploaded/videos
//audios in the uploaded/audio

class photo_uploads{
    
    
    public $photo_name,$file_type,$tmp_loc,$file_error;
	public $cover_photo_name,$cover_file_type,$cover_tmp_loc,$cover_file_error;
    private $upload_dir="Uploaded";
    public $Object_path,$video_path,$Object_cover_path;
    public $move_to;
    protected $upload_errors=array(
         
         UPLOAD_ERR_OK => "No Errors",
         UPLOAD_ERR_NO_FILE => "No file was chosen",
         UPLOAD_ERR_INI_SIZE => "The file size exceeds the expected",
         UPLOAD_ERR_FORM_SIZE => "File is larger than form max size",
         UPLOAD_ERR_PARTIAL => "Error encountered,Partial upload",
         UPLOAD_ERR_CANT_WRITE => "No enough permission to upload the file",
         UPLOAD_ERR_EXTENSION => "Upload stopped by extension",
         UPLOAD_ERR_NO_TMP_DIR => "No temporary directory to write to"
         
     );
    
/* function __construct() {
     
 }*/

 function path_name($path){
      $this->Object_path=$path;
 }

 function video_path_name($path){
      $this->video_path=$path;
 }
 
 function path_cover_name($path){
      $this->Object_cover_path=$path;
 }
 
 public function set_photo_name($photo_name)
 {
     $this->photo_name = $photo_name;
 }
 
 public function set_file_type($file_type)
 {
     $this->file_type = $file_type;
 }
 
 public function set_tmp_loc($tmp_loc)
 {
     $this->tmp_loc = $tmp_loc;
 }
 
 public function set_file_error($file_error)
 {
     $this->file_error = $file_error;
 }
 
 public function set_cover_photo_name($cover_photo_name)
 {
     $this->cover_photo_name = $cover_photo_name;
 }
 
 public function set_cover_file_type($cover_file_type)
 {
     $this->cover_file_type = $cover_file_type;
 }
 
 public function set_cover_tmp_loc($cover_tmp_loc)
 {
     $this->cover_tmp_loc = $cover_tmp_loc;
 }
 
 public function set_cover_file_error($cover_file_error)
 {
     $this->cover_file_error = $cover_file_error;
 }
 
 function validate_image(){
     $this->move_to=basename($this->photo_name);
     
     if($_FILES){
         $name=$this->photo_name;
         $target_dir=$this->upload_dir.DS.'Images'.DS.$this->move_to;
         $temp_loc=$this->tmp_loc;

            switch($this->file_type){
             case 'image/jpeg':$image=true; break;
             case 'image/jpg':$image=true; break;
             case 'image/png':$image=true; break;
             default: $image=false; break;
             
            }
            
         if($image){


              /* echo "<img src='$target_dir' width='150px' height='150px'> <br/>"; */
               if(move_uploaded_file($temp_loc, $target_dir))
               {
                    $this->path_name($target_dir);
                 //echo "Upload successful <br/>";

                    // the if statement to resize pictures
                  if($this->file_type == 'image/jpeg' || $this->file_type == 'image/jpg') {
                        $src = imagecreatefromjpeg($target_dir);
                    
                        list($width,$height) = getimagesize($target_dir);

                        $new_width = 1500;
                        $new_height = ($height / $width) * $new_width;

                        $tmp = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        imagejpeg($tmp,$target_dir,100);

                        imagedestroy($src);
                        imagedestroy($tmp);
                    } else if($this->file_type == 'image/png') {
                        $src = imagecreatefrompng($target_dir);
                        list($width,$height) = getimagesize($target_dir);

                        $new_width = 1500;
                        $new_height = ($height / $width) * $new_width;

                        $tmp = imagecreatetruecolor($new_width, $new_height);
                        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
                        imagepng($tmp,$target_dir,9);

                        imagedestroy($src);
                        imagedestroy($tmp);
                    }

                    return true;
                 
               } 
          } else { //if the uploaded file is not an image
                echo "The uploaded file must be an image! <br/>" ;
                echo "Upload unsuccessful! Try again later" ;
           }
            
        //if an error occurs
            if($error=$this->file_error){ 
               echo $this->upload_errors[$error]."<br/>";
               echo "Upload unsuccessful! Try again later";
              }
     }
 }
 
 
  //START validate_video fn
 function validate_video($file){
     $move_to=basename($_FILES[$file]['name']);
     
     if($_FILES){
         $name=$_FILES[$file]['name'];
         $target_dir_video=$this->upload_dir.DS.'Videos'.DS.$move_to;
         $temp_loc=$_FILES[$file]['tmp_name'];
         
        switch($_FILES[$file]['type']){
             
             case 'video/mpeg':$video=true; break;
             case 'video/mp4':$video=true; break;
             case 'video/quicktime': $video=true; break;
             case 'video/avi' : $video=true; break;
             case 'video/wmv' : $video=true; break;
             case 'video/flash' : $video=true; break;
             case 'video/webm' : $video=true; break;
             case 'video/ogg' : $video=true; break;
             default: $video=false; break;
            }
      
       if($video){

           if(move_uploaded_file($temp_loc, $target_dir_video))
           {
             $this->video_path_name($target_dir_video);
             return true;
             
           } 
      } else { //if the uploaded file is not a video
            $message = "The uploaded file must be a video! <br/>";
            $message .= "Upload unsuccessful! Try again later";
       }
        //if an error occurs
             if($error=$_FILES[$file]['error']){ 
               $message = $this->upload_errors[$error]."<br/>";
               $message .= "Upload unsuccessful! Try again later";
              }
     }
     echo $message;
 }
    //END validate_video fn
 
}

$upload=new photo_uploads();

?>