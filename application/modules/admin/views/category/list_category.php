<html>
    <head>

    <script type="text/javascript">
        function checkdel(){
        	if(confirm("Bạn có muốn xóa không?")){
        		return true;
        	}else{
        		return false;
        	}
        }
    </script>
        <meta http-equiv="content-type" content="text/html:charset='utf-8'"/>
        <title> List category</title>
    </head>
    <body>
        <div class="menu_category"></div>
        <div class="content_category">
            <?php
                foreach( $data as $key => $value){
                    $dulieu[]=$value;
                }
                //echo"<pre>";print_r($dulieu);echo"</pr>";
                $count = count($dulieu);
                //echo $count;
                echo "<ul '><li>".$dulieu[0]['category_name']."<a href=''> Sửa </a> <a href=''> Xóa </a>"."</li>";
                for( $i=1 ; $i<$count ; $i++){
                    if($dulieu[$i]['level'] > $dulieu[$i-1]['level']) echo"<ul><li>".$dulieu[$i]['category_name']
                        ."<a href=''> Sửa </a> <a href=''> Xóa </a>"."</li>";
                    else if($dulieu[$i]['level'] == $dulieu[$i-1]['level']) echo"<li>".$dulieu[$i]['category_name']
                        ."<a href=''> Sửa </a> <a href=''> Xóa </a>"."</li>";
                    else{
                        for( $j=1; $j<=$dulieu[$i-1]['level']-$dulieu[$i]['level']; $j++){
                            echo"</ul>";
                        }
                        echo"<li>".$dulieu[$i]['category_name']."<a href=''> Sửa </a> <a href=''> Xóa </a>"."</li>";
                    }
                }
                echo"</ul>";
            ?>
        </div>
    </body>      
</html>  
    