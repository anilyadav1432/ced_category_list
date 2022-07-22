<?php
if(isset($_POST['save_cats']) && $_POST['cat_check']){
    $cat_arr = $_POST['cat_check'];
    // $cat_ids = $_POST['caty_id'];
    // echo "<pre>";
    // print_r( $cat_ids);
    // die();
    // print_r($cat_arr);
    $cat_arr = implode(",",$cat_arr);
    if ( get_option( 'all_cat_list' ) !== false) {       
        update_option( "all_cat_list", $cat_arr );
        $msg = "Data successfully update";
    }else{
        $deprecated = null;
        $autoload   = 'no';
        add_option( "all_cat_list", $cat_arr, $deprecated, $autoload );
        $msg = "Data not save";
    }
}



$orderby = 'name';
$order = 'asc';
$hide_empty = false ;
$cat_args = array(
    'orderby'    => $orderby,
    'order'      => $order,
    'hide_empty' => $hide_empty,
);
 
$product_categories = get_terms( 'product_cat', $cat_args );
 
if( !empty($product_categories) ){
    if(isset($msg) && !empty($msg)){
        echo '<div id="hideMeAfter5Seconds">"'.$msg.'"</div>';
    }
?>
<style>
#hideMeAfter5Seconds {
  animation: hideAnimation 0s ease-in 3s;
  animation-fill-mode: forwards;
  font-size:25px;
  color:green;
  text-align:center;
  margin-top:10px;
}

@keyframes hideAnimation {
  to {
    visibility: hidden;
    width: 0;
    height: 0;
  }
}
</style>
    <h1 style="text-align:center;">Categories List</h1>

    <form action="" method="post">
    <table border="1" style="padding:10px; margin:0px auto;width:500px;box-shadow:5px 15px 10px lightgray;">
        <tr>
            <th>Checkbox</th>
            <th>Sr.no</th>
            <th>Category Name</th>
        </tr>
<?php
    $sno = 1;
    $saved_cat = explode(",",get_option('all_cat_list', array() ));
    // print_r($saved_cat);
    foreach ($product_categories as $key => $category) {
        ?>
        <!-- <input type="text" name="caty_id" value="echo $category->term_id; ?>"> -->
        <tr><td><input type="checkbox" name="cat_check[]" value="<?php echo $category->name; ?>" <?php echo in_array($category->name,$saved_cat)?"checked":""; ?>></td>
        <td><?php echo $sno; ?></td>
       <td><a href="<?php echo get_term_link($category) ?>" >
       <?php echo $category->name; ?>
        </a></td></tr>
        <?php
        $sno++;
    }
?>
    <tr><td colspan="3"><input type="submit" value="Save" name="save_cats" style="width:135px;height:40px;color:white;background:green;"></td></tr>
    </table>
    </form>
<?php
}
