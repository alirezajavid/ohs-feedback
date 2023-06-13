<?php ob_start(); $s1 = ob_get_contents(); ?>
 <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>
            .page_break { page-break-before: always; }
            table {
                width:100%;
            }
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;            
            }
            th, td {
                padding: 7px;
            }
            th {
                text-align: right;
            }
            h3 {
                text-align: center;
                margin-top: 50px;
            }
            td.Yes {
                color: black;
                font-weight: bolder;
                padding-left: 20px;
                background-size: 24px;
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-position: 4px 10px;                
                background-image: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAMAAAAoLQ9TAAAAAXNSR0IB2cksfwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAMlQTFRF////9Pnvzea25/Pc1+vFlsppdbo5vd6h/v/+1+rEbLUsYrAeodB49frx/v79ut2clcpn9vry0ui+c7k2kchh4vDVzea3dbo6crg18/nt4/HWbLUtdro61OnA+Pz14O/S5PLY9/vz2uzJebw/ZbEiwuCoy+W1cbg0brYwhcJQ3O3M8vjsiMNVg8FM9/v0q9WGZLEgYrAfarQq+fz3+fz25vPcj8df7fbl3e7OZLEhlMllnM1xdLk41erC5/Pdnc5z+/36xuKt0+nAXlSCTgAAAIhJREFUeJxjYEAGjEzMKHwWVjZ2JC4HJxc3Dy+Cz8fPxS0giMQXEuYWEUXSICbOLSGJxJeS5paRBbPk5BUUGRiUlLlVVCFSauoamlraOtzculAL9PQNuA2EDbmN1GC6jQW4QUDfBG6eqRmQb2SOZIOFJTe3FYofrC1tbFEE7DTtHVAEGByd4EwAin4K1nUKyv0AAAAASUVORK5CYII=)
            }
            td.No {
                color:gray;
                text-decoration: line-through;
            }
        </style>
    </head>
    <body>
        <div style="width:190mm">
            <center>
                <img src="data:image/png;base64,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" width="120px"/>
            </center>
            <h1 align="center"></h1>
            <table border="0">
                <tr>
                    <th width="100px">Name:</th><td><?php echo @$obj->name ?></td>
                </tr>
                <tr>
                    <th width="100px">Email:</th><td><?php echo @$obj->email ?></td>
                </tr>
                <tr>
                    <th width="100px">Mobile:</th><td><?php echo @$obj->mobile ?></td>
                </tr>
            </table>
            <br />
            
            <?php
                $i = explode(',', @$obj->category);
                print $i[0];
                ?>
            <table>
                <tr>
            <?php
                $g = ['Safety','Environmental','Culture','Community','Quality'];
                foreach ($g as $key => $v) {
                    print "<td ".(in_array($v, $i)? "class='yes'":'').">" . $v . "</td>";
                }
            ?>
                </tr>
            </table>
            <hr>
            <?php echo @$obj->type ?>
            <hr>
            <b>Comment</b>
            <blockquote>
            <?php echo @$obj->comment ?>
            </blockquote>
        </div>
    </body>
</html><?php $RETURNVALUE_STRING = ob_get_contents(); ob_end_clean(); ?>