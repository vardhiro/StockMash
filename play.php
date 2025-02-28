<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<style>
    body{
        background-color: black;   
        color: white; 
    }

    input, option, select{
        color: white;
        background-color: black;
    }

    .stock{
        display : inline-block;
        top: 10;    
        margin-right: 10px;
        background-color: #696969;
        color: rgba(221, 230, 171, 0.93);;
        font-family: Verdana, Geneva, Tahoma, sans  -serif;
        padding: 15px;
        width: 30%;
        height: 50vh;
        overflow: hidden;
    }

    #playereval{
        display : inline-block;
        top: 10;    
        margin-right: 10px;
        background-color: rgba(16, 15, 15, 0.91);
        color: rgba(226, 219, 30, 0.91);
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding: 15px;
        width: 60%;
    }

    @media (max-width:700px) {
        .stock{
            display: block;
            margin-bottom: 10px;
            width: 80vw;
            height: 60vh;
        }
    }
    #stock3, #stock5, #stock6, #stock7, #stock9, #stock11 {
        visibility: hidden;
    }
    #game{
        visibility: hidden;
    }
</style>
<?php
$filename = "data.txt";
$data = explode("\n",file_get_contents($filename));
include ("arr.php");
$i = 0;
?>
<center>

<div id="playereval">
    <h1>BEFORE WE START</h1>
    <h2>Lets get a bit of details, shall we?</h2>
    <?php include "valform.php"; ?>
</div>
<div id="game">
        <h1>
            PICK ONE
        </h1>
        <?php
        
foreach ($randomElements as $row) {
    $i++;
    $symbol = explode(".",$row)[0];
    if ($i%2 != 0){
        echo "<div class = 'compare' id = 'stock$i'>
            <div id = '$symbol' class = 'stock' onClick=\"call$i('".trim(explode(".",$row)[0])."','".trim(explode(".",$randomElements[$i])[0])."')\">
                <h1>".explode(".",$row)[1]."</h1>
            </div>
            ";
    }else{
        echo "<div id = '$symbol' class = 'stock' onClick=\"call".($i-1)."('".trim(explode(".",$row)[0])."','".trim(explode(".",$randomElements[$i-2])[0])."')\">
            <h1>".explode(".",$row)[1]."</h1>
        </div><br>
        </div>
        <script>
            function call".($i-1)."(win, lose){
                document.getElementById('stock".($i-1)."').style.height = '0';
                document.getElementById('stock".($i-1)."').style.visibility = 'hidden';
                document.getElementById('stock".($i+1)."').style.visibility = 'visible';
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.open('GET', 'fileupdate.php?win='+win+'&lose='+lose+'&opinion='+points, true);
                xmlhttp.send();
            }
        </script>
        ";
    }
    ?>
    <script>
        var xmlhttp=new XMLHttpRequest();
      xmlhttp.onreadystatechange=function() {
        if (this.readyState==4 && this.status==200) {
          document.getElementById("<?php echo $symbol;?>").innerHTML+=this.responseText;
        }
      }
        xmlhttp.open("GET","getdata.php?symbol=<?php echo $symbol; ?>",true);
        xmlhttp.send();
    </script>
  <?php
}
?>

<div class="compare" id="stock11">
    <h1>THANK YOU!! HAVE a nice day or RELOAD to play!</h1>
    <a href="board.php" style="color: yellow;">Check The LeaderBoard here</a>
</div>
</div>
</center>