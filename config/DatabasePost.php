<?php

class DatabasePost extends DatabaseConnection
{
    public function registerUser($email, $username, $password)
    {
        $sql = 'INSERT INTO user (email, username, user_password) VALUES (:email, :username, :user_password)';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('email', $email);
        $stmt->bindValue('username', $username);
        $stmt->bindValue('user_password', $password);
        $stmt->execute();
    }

    public function loginUser($email, $password)
    {
        $sql = 'SELECT * FROM user WHERE email = :email';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('email', $email);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() > 0) {
            if (password_verify($password, $result['user_password'])) {
                $_SESSION['username'] = $result['username'];
                $_SESSION['user_id'] = $result['id'];

                header('location: ../index.php');
            } else {
                echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
                The email or password is wrong
                </div>";
            }
        } else {
            echo "<div class='alert alert-danger bg-danger text-center text-white' role='alert'>
                The email or password is wrong
                </div>";
        }
    }

    public function logoutUser()
    {
        session_start();
        session_unset();
        session_destroy();

        header('location: http://localhost/clean-blog/index.php');
    }

    public function createPost($title, $subtitle, $body, $category_id, $img, $user_id, $user_name, $dir)
    {
        $sql = 'INSERT INTO posts (title, subtitle, body, category_id, img, user_id, user_name) VALUES (:title, :subtitle, :body, :category_id, :img, :user_id, :user_name)';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('title', $title);
        $stmt->bindValue('subtitle', $subtitle);
        $stmt->bindValue('body', $body);
        $stmt->bindValue('category_id', $category_id);
        $stmt->bindValue('img', $img);
        $stmt->bindValue('user_id', $user_id);
        $stmt->bindValue('user_name', $user_name);
        $stmt->execute();

        if (move_uploaded_file($_FILES['img']['tmp_name'], $dir)) {
            header('location: http://localhost/clean-blog/index.php');
        }
    }

    public function showPost()
    {
        $sql = 'SELECT * FROM posts';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function showFullPost($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function deletePost($id)
    {
        $sql = 'DELETE FROM posts WHERE id = :id';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        header('location: http://localhost/clean-blog/index.php');
    }

    public function deleteImage($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function editPost($id)
    {
        $sql = 'SELECT * FROM posts WHERE id = :id';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function updatePost($id, $title, $subtitle, $body, $img)
    {
        $sql = 'UPDATE posts SET title = :title, subtitle = :subtitle, body = :body, category_id = :category_id img = :img WHERE id = :id';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('title', $title);
        $stmt->bindValue('subtitle', $subtitle);
        $stmt->bindValue('body', $body);
        $stmt->bindValue('img', $img);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        header('location: http://localhost/clean-blog/index.php');
    }

    // categories section starts

    public function showCategories()
    {
        $sql = 'SELECT * FROM categories';
        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    public function postCategories($id)
    {
        $sql = 'SELECT posts.id AS id, posts.title AS title, posts.subtitle AS subtitle,
        posts.user_name AS user_name, posts.created_at AS created_at, posts.category_id as category_id
        FROM categories JOIN posts ON categories.id = posts.category_id WHERE posts.category_id = :id';

        $stmt = $this->databaseConfig()->prepare($sql);
        $stmt->bindValue('id', $id);
        $stmt->execute();

        while ($result = $stmt->fetchAll()) {
            return $result;
        }
    }

    // categories section ends

    // profile section starts

     public function editProfile($id)
     {
         $sql = 'SELECT * FROM user WHERE id = :id';
         $stmt = $this->databaseConfig()->prepare($sql);
         $stmt->bindValue('id', $id);
         $stmt->execute();

         while ($result = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
             return $result;
         }
     }

  public function updateProfile($id, $email, $username)
  {
      $sql = 'UPDATE user SET email = :email, username = :username WHERE id = :id';
      $stmt = $this->databaseConfig()->prepare($sql);
      $stmt->bindValue('email', $email);
      $stmt->bindValue('username', $username);
      $stmt->bindValue('id', $id);
      $stmt->execute();

      header('location: http://localhost/clean-blog/users/profile.php?profile_id='.$_SESSION['user_id'].'');
  }
    // profile section ends

    // user-admins section starts

    // user login
}
