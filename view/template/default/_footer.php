<div class="footer">
    <span id="TimeShow"></span>
    &copy; BIT1010 2014 All Rights Reserved .  Powered by <a href="http://www.bit1010.com">BITWORD v1.0</a>
    
</div>

<script language="javascript" type="text/javascript">
    window.onload = function(){ 
        document.getElementById("TimeShow").innerHTML = "加载耗时"+ (new Date().getTime()-reqTime)/1000 +"s"; 
    } 
</script>

<script type="text/javascript" src="view/public/js/jquery.js"></script>
<script type="text/javascript" src="view/public/js/jquery.form.js"></script>
<script type="text/javascript" src="view/public/js/jquery.lazyload.min.js"></script>
<script type="text/javascript" src="<?=$webroot.'/'.$tpl_root.'/js/defualt.js' ?>"></script>
<?=stripslashes(base64_decode($accstat))?>
