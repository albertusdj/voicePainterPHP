<?php 
//old name
$input = $_FILES['audio_data']['tmp_name']; //get the temporary name that PHP gave to the uploaded file
//new name
$output = $_FILES['audio_data']['name'].".wav"; //letting the client control the filename is a rather bad idea

//move the file from temp name to local folder using $output name
move_uploaded_file($input, $output);

//textfile name
$textname = 'list.txt';

//write filename to textfile
$the_file = fopen($textname, "w");
fwrite($the_file, $output);
fclose($the_file);

//command to predict voice from file $textname and output the result to $outputfile
$command = 'julius-4.3.1 -input rawfile -filelist '.$textname.' -C voxforge/manual/sample.jconf';

//output array
$output_array = array();

//run the command
exec($command, $output_array);

$itr = strpos($output_array[3], "<s>") + 4;

$array_of_char = str_split($output_array[3]);

$result = "";

while(strcmp($array_of_char[$itr], "<") !== 0) {
  $result .= $array_of_char[$itr];
  $itr += 1;
}

$result = substr($result, 0, strlen($result)-1);

$data = ['command' => $result];
header('Content-Type: application/json');
echo json_encode($data);
?>