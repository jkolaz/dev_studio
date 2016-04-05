<script type="text/javascript" src="<?php echo base_url() ?>js/sistema/rol.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript" src="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript">
    $(document).ready( function() {
        base_url   = $("#base_url").val();
        $("#nuevo_rol").click( function() {
            var url = $(this).attr('href');
            location.href = url;
        } ); 
        $(".ver_rol").fancybox( {
            'width'          : 700,
            'height'         : 650,
            'transitionIn'   : 'elastic',
            'transitionOut'  : 'elastic',
            'type'	     : 'iframe'
        } );
    } );
</script>

<br>

<br>
<div class="header"><?php echo $titulo ?></div>

<div id="container">
    <div class="demo_jui">
        <table cellpadding="0" cellspacing="0" border="0" class="display" id="roles">
            <thead>
                <tr>
                    <th> N </th>
                    <th> FEC. REG. </th>
                    <th> TIPO </th>
                    <th> ADMIN </th>
                    <th> TAREA </th>
                    <th> UUARIO </th>
                    <th> MENSAJE </th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($lista) {
                    $i = 1;
                    foreach ($lista as $objeto) {
                        $aColum = explode('|', $objeto);
                ?>
                <tr>
                    <td align="center"><?=$i?></td>
                    <td style="text-align: justify; padding-left: 20px;"><?=$aColum[2]?></td>
                    <td style="text-align: justify; padding-left: 20px;"><?=$aColum[0]?></td>
                    <td style="text-align: left; padding-left: 20px;"><?=$aColum[8]?></td>
                    <td style="text-align: justify; padding-left: 20px;"><?=$aColum[6]?></td>
                    <td style="text-align: justify; padding-left: 20px;"><?=$aColum[9]?></td>
                    <td style="text-align: left; padding-left: 20px;"><?=$aColum[3]?></td>
                </tr>
                <?php
                        $i++;
                    }
                }
                ?>
            </tbody>
        </table>
        <input type="hidden" name="base_url" id="base_url" value="<?php echo base_url() ?>">
    </div>
</div>
<br><br>
