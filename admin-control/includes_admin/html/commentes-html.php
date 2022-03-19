
<div class="section_manger">
  <h1 class="text-center">comments manger</h1><a class="btn btn-primary" href="comments.php?action=add">add new comment</a>
  <div class="table-responsive">
    <table class="table table-bordered text-center">
      <tr class="thead"> 
        <td>id</td>
        <td>comment</td>
        <td>date</td>
        <td>items</td>
        <td>user</td>
        <td>control</td>
      </tr><?php foreach($comment as $comm) {?> 
      <tr>
        <td><?php echo $comm['comment_id']?></td>
        <td><?php echo $comm['comment']?></td>
        <td><?php echo $comm['comment_date']?></td>
        <td><?php echo $comm['Name']?></td>
        <td><?php echo $comm['UserName']?></td>
        <td> <a class="btn btn-success" href="">edit</a><a class="btn btn-danger" id="del-comm" onclick="clickme()" href="?action=delete&amp;comment=&lt;?php echo $comm['comment_id']?&gt;">delete</a>
          <p></p>
        </td>
      </tr><?php }?>
    </table>
  </div>
</div>