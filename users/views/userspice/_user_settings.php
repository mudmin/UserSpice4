<span class="bg-danger"><?=display_errors($errors);?></span>
          <div id='regbox'>
          <form name='updateAccount' action='user_settings.php' method='post'>
            <p>
          <img src="<?=$grav; ?>" alt=""class="left-block img-thumbnail" alt="Generic placeholder thumbnail">
            </p>
          <p><a href="https://en.gravatar.com/">Don't have a profile pic? Get one!</a>
          <p>
            <label>Username:
              <input  class='form-control' type='text' name='username' value='<?=$userdetails->username?>' /></label>
            </p>
          <p>
            <label>First Name:
              <input  class='form-control' type='text' name='fname' value='<?=$userdetails->fname?>' /></label>
            </p>
          <p>
            <label>Last Name:
              <input  class='form-control' type='text' name='lname' value='<?=$userdetails->lname?>' /></label>
            </p>
          <p>
            <label>Email:
              <input class='form-control' type='text' name='email' value='<?=$userdetails->email?>' /></label>
            </p>
          <p>
          <label>Old Password:</label>
          <input class='form-control' type='password' name='old' />
          </p>
          <p>
          <label>New Password (8 character minimum):</label>
          <input class='form-control' type='password' name='password' />
          </p>
          <p>
          <label>Confirm Password:</label>
          <input class='form-control' type='password' name='confirm' />
          </p>

          <input type="hidden" name="csrf" value="<?=Token::generate();?>" >
          <p>
          <label></label>
          <input class='btn btn-primary' type='submit' value='Update' class='submit' />
          </p>
          </form>
