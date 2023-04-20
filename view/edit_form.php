<form action="../modules/edit_action.php" method="GET">
   <div class="row justify-content-between text-white p-2">
    
        <div class="form-group flex-fill mb-2">
            <input id="todo-input" name="title" type="text" class="form-control" value="SOME VALUE">
        </div>
        <button  onclick="location='../index.php'" class="btn btn-outline-secondary bg-danger text-white" type="submit"  id="button-addon3" name="payload" value="<?php echo $_GET['item_id'] ?>"
        >
        Edit
        </button>
    
    </div>
</form>