<?php
session_start();
require_once('config.php');



echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

$id = $_GET['id']??$_POST['id']?? null;
$loggedUser = $_SESSION['loggedUser']?? '';

 
$sqlQuery = 'SELECT * FROM posts Where id= :id ';
// send one request
$postStatement = $db->prepare($sqlQuery);
$postStatement->execute( ['id'=>$id]);
$post = $postStatement->fetch(PDO::FETCH_ASSOC);


echo '<pre>';
var_dump($post);
echo '</pre>';
$errors=[];
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $image = $_FILES['image']?? '';
    $title= $_POST['title'];
    $subtitle = $_POST['subtitle'];
    $content = $_POST['content'];
    $author = $_SESSION['loggedUser']['username']?? '';
    $date = date('Y-m-d H:i:s');
    $id = $_POST['id'];

    if (! $title){
        $errors['title'] = 'Title is required !';
    }
    if (! $subtitle){
        $errors['subtitle'] = 'Subtitle is required !';

    }
    if (! $content){
        $errors['content'] = 'Content is required !';
    }
    if(! $author){
        $errors['author'] = 'Your have to login first !';
    }

     $_SESSION['post_data'] =[
        'image' => $_FILES['image']??  '',
        'title'=> $_POST['title'],
        'subtitle' => $_POST['subtitle'],
        'content' => $_POST['content'],
        'author' => $_SESSION['loggedUser']['username']?? '',
        'date' => date('Y-m-d H:i:s')
    ]; 

    if (!is_dir('images')){
        mkdir('images');
    }
    $imagePath=$post['image'];
    echo '<pre>';
        var_dump($_FILES);
        echo '</pre>';
    if($image && $image['tmp_name']){
        if($post['image']){
            unlink($post['image']);
        }
            
        
        $imagePath ='images/'.$_POST['title'].'update'.'/'.$image['name'];
        mkdir(dirname($imagePath));
        move_uploaded_file($image['tmp_name'], $imagePath);

        }
    


    if(!empty($errors)){
        $_SESSION['errors']=$errors;

    }else{
      
        
        $sqlQuery = 'UPDATE posts SET image=:image, title=:title, subtitle=:subtitle, content=:content, author=:author, date=:date WHERE id=:id';
        $updatePost = $db->prepare($sqlQuery);
        $updatePost->execute([
            'image' =>$imagePath,
            'title'=>$title,
            'subtitle'=>$subtitle,
            'content'=>$content,
            'author'=>$author,
            'date'=>$date,
            'id'=>$id
        ]);
         header('location: posts.php');
        exit;  
    }
    header('location: update.php');
    exit;

  

}
$postData =[];
$postErrors =[];
    

if (array_key_exists('errors', $_SESSION) && array_key_exists('post_data', $_SESSION)){
    $postData = $_SESSION['post_data'];
    $postErrors = $_SESSION['errors'];

    echo '<pre>';
    var_dump($postData);
    echo '</pre>';
    unset($_SESSION['errors'], $_SESSION['post_data']);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="app.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>My Blog</title>
</head>

<body>
    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="col-sm-8">
            <form action="update.php" method="post" enctype="multipart/form-data">
                <div class="<?php echo $postErrors? 'alert alert-danger' : '' ?>">
                    <?php foreach($postErrors as $error){
                                echo $error . '!<br> ';
                            } ?>

                </div>
                <div class="mb-3">
                    <img src=" <?php echo $post['image'] ?>" alt="" class="post-image">

                    <label for="exampleFormControlInput1" class="form-label">Image</label>
                    <input type="file" class="form-control " id="exampleFormControlInput1" placeholder="Title"
                        name="image" value="<?php echo $postData['image']?? $post['image']?? ''?>">
                </div>

                <div class="mb-3">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <label for="exampleFormControlInput1" class="form-label">Title</label>
                    <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Title"
                        name="title" value="<?php echo $postData['title']?? $post['title']?? ''?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Subtitle</label>
                    <input type="text" class="form-control " id="exampleFormControlInput1" placeholder="Subtitle"
                        name="subtitle" value="<?php echo $postData['subtitle']?? $post['subtitle']??'' ?>">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Content</label>
                    <textarea type="text" class="form-control " id="exampleFormControlInput1"
                        placeholder="Write somthing here ..." cols="30" rows="10" name="content"
                        value="<?php echo $postData['content']?? $post['content']??'' ?>">
                    </textarea>
                </div>


                <button type="submit" class="btn btn-primary btn-lg">Update Post</button>
            </form>

        </div>

    </div>

    <?php include_once('footer.php'); ?>

</body>

</html>