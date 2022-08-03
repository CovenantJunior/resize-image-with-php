<?
    if(isset($_FILES['attachment'])){
    //Condition to checek for the POST request having a file name, "attachment"
    
        //Rezise image/compress function
        function resizeImage($resourceType, $image_width, $image_height) {
            /* ======= THESE CRITERIA OR CALCULATIONS CAN BE TWEAKED TO BEST SUIT YOUR UTILIZATION FOR YOUR WEB APP ======= */
                if ($image_width>2000) {
                $resizeWidth = $image_width/5;
                $resizeHeight = $image_height/5;
                }
                elseif ($image_height>=1500) {
                    $resizeWidth = $image_width/4;
                    $resizeHeight = $image_height/4;
                }
                elseif ($image_height>=1000) {
                    $resizeWidth = $image_width/3;
                    $resizeHeight = $image_height/3;
                }
                elseif ($image_height>=500) {
                    $resizeWidth = $image_width/1.5;
                    $resizeHeight = $image_height/1.5;
                }
                else{
                    $resizeWidth = $image_width;
                    $resizeHeight = $image_height;
                }
            /* ======= THESE CRITERIA OR CALCULATIONS CAN BE TWEAKED TO BEST SUIT YOUR UTILIZATION FOR YOUR WEB APP ======= */

            $imageLayer = imagecreatetruecolor($resizeWidth, $resizeHeight);
            imagecopyresampled($imageLayer, $resourceType,0,0,0,0, $resizeWidth, $resizeHeight, $image_width, $image_height);
            return $imageLayer;
        }
        $fileName = $_FILES['attachment']['tmp_name'];
        if($sourceProperties = getimagesize($fileName)){
            //Check if the image is valid (has properties e.g height, width, etc)
        }
        else{
            //Output any custom error
            
            exit();
            //Stops the program/page (since no image property)
        }

        $fileExt = pathinfo($_FILES['attachment']['name'], PATHINFO_EXTENSION);
        //Get file extension

        $size = $_FILES['attachment']['size']/1000;
        //Get file size in kb (kilobytes)

        $image_name = "Attachment-".time();
        //e.g. Attachment-1658790864 . Or any custom naming process

        $image = md5($image_name).".".$fileExt;
        //File name on server

        $uploadPath = '../(path-to-preferred-image-directory)/'.$image.'';
        // e.g '../(path-to-preferred-image-directory)/198456e3cec6961120b5e6bc439423f7.png'

        $uploadImageType = $sourceProperties[2];
        $sourceImageWidth = $sourceProperties[0];
        $sourceImageHeight = $sourceProperties[1];

        //About to get sophisticated

        if ($size>250) {
            /* ======= IF IMAGE SIZE LIMIT IS CROSSED (FOR THIS PROGRAM THE LIMIT IS 250kb) ======= */
            switch ($uploadImageType) {
                case IMAGETYPE_JPEG:
                    $resourceType = imagecreatefromjpeg($fileName); 
                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
                    $file = imagejpeg($imageLayer, $uploadPath);
                    break;
    
                case IMAGETYPE_GIF:
                    $resourceType = imagecreatefromgif($fileName); 
                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
                    $file = imagegif($imageLayer, $uploadPath);
                    break;
    
                case IMAGETYPE_PNG:
                    $resourceType = imagecreatefrompng($fileName); 
                    $imageLayer = resizeImage($resourceType, $sourceImageWidth, $sourceImageHeight);
                    $file = imagepng($imageLayer, $uploadPath);
                    break;
    
                default:
                    $imageProcess = 0;
                    break;
            }

            move_uploaded_file($file, '../(path-to-preferred-image-directory)/'.$image.'');
            //Move client file to server

            //Save necessary data in database. e.g. image name, file name, file size, file extension, path and inserted date
            $qryin = /* ======= INSERT INTO A DATABASE ======= */
        
            if($qryin){
                //If inserted... Up tp you... 🙂
            }
            else{
                //If not.. Up tp you... 🙂
            }
        }
        else{
            /* ======= IF IMAGE SIZE LIMIT ISN'T CROSSED ======= */

            move_uploaded_file($_FILES['attachment']['tmp_name'], '../(path-to-preferred-image-directory)/'.$image.'');
            $qryin = /* ======= INSERT INTO A DATABASE ======= */
        
            if($qryin){
                //If inserted... Up tp you... 🙂
            }
            else{
                //If not.. Up tp you... 🙂
            }
        }
    }
?>