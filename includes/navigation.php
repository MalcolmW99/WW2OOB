<table border="0" cellpadding="0" cellspacing="0" style="width: 100%; height: 100%">

            <tr>
                <td style="height: 23px" bgcolor="#cccccc" width="120">
                    <Button type = "button" Name = "btnhome" style="background-color: Silver" Width="120px" onclick="window.location.href='index.php'">Home</button></td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="118px" onclick="window.location.href='WW2Events.php'"> Events</button>
                    </td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="120px" onclick="window.location.href='OOB.php'">OOB</button></td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="120px" onclick="window.location.href='selectbook.php'">Select Book</button></td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="120px" onclick="window.location.href='campaign.php'">Select Campaign</button></td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="106px" onclick="window.location.href='findunit.php'">Select Unit</button></td>
                <td bgcolor="#cccccc" style="height: 23px" width="120">
                    <Button type = "button" Width="118px" onclick="window.location.href='displayunit.php'">Display Unit</button></td>
                <td bgcolor="#cccccc" style="height: 23px; width: 108px;">
                    <Button type = "button" Width="120px" onclick="window.location.href='world.php'"> World Locations</button></td>
                <td bgcolor="#cccccc" style="height: 23px; width: 121px;">
                    <Button type = "button" Width="113px" onclick="window.location.href='timeline.php'">Timeline</button>
                    </td>
                <td bgcolor="#cccccc" style="width: 108px; height: 23px">
                    <Button type = "button" Width="120px" onclick="JavaScript:alert('Links pressed')">Links</button></td>
            </tr>
<!--            <tr>
                <td bgcolor="#cccccc" style="height: 10px; text-align: right;" width="120">
                    Select Force -&gt;</td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: LightSteelBlue" Width="120px" onclick="JavaScript:alert('Air Force pressed')">
                        Air Force</button></td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: Olive; color: white" Width="120px" onclick="JavaScript:alert('Army pressed')">Army</button></td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: navy; color: white" Width="120px" onclick="JavaScript:alert('Navy pressed')">Navy</button></td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: lightyellow; color: black" Width="120px" onclick="JavaScript:alert('Politics pressed')">Politics</button></td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: lime; color: black" Width="120px" onclick="JavaScript:alert('Civil pressed')">Civil</button></td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
                    <Button type = "button" style="background-color: lime" Width="120px" onclick="JavaScript:alert('Business pressed')">Business</button></td>
                <td bgcolor="#cccccc" style="height: 10px">
                    <Button type = "button" style="background-color: red" Width="120px" onclick="JavaScript:alert('Misc pressed')">Misc</button></td>
                <td bgcolor="#cccccc" style="height: 10px">
                    <Button type = "button" Width="120px" onclick="JavaScript:alert('All forces pressed')">All Forces</button></td>
                <td bgcolor="#cccccc" colspan="1" style="height: 10px">
                    <Button type = "button" Width="120px" onclick="JavaScript:alert('Clear Unit pressed')">Clear Unit</button></td>
            </tr>  -->
            <tr>
                <td bgcolor="#cccccc" style="height: 10px; text-align: right" width="120">
                    Select Country-&gt;</td>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "Chairman of China";
                echo "<Button type = \"button\" style=\"background-color: aqua\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">China</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "Fr President";
                echo "<Button type = \"button\" style=\"background-color: aqua\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">France</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "Fuehrer";
                echo "<Button type = \"button\" style=\"background-color: red\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">Germany</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "King of Italy";
                echo "<Button type = \"button\" style=\"background-color: red\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">Italy</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "Emperor of Japan";
                echo "<Button type = \"button\" style=\"background-color: red\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">Japan</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "British Monarchy";
                echo "<Button type = \"button\" style=\"background-color: aqua\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">UK</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "US President";
                echo "<Button type = \"button\" style=\"background-color: aqua\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">USA</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px" width="120">
<?php			$temp = "Leader of the Soviet Union";
                echo "<Button type = \"button\" style=\"background-color: aqua\" Width=\"120px\" onclick=\"window.location.href='displayunit.php?unit=$temp'\">USSR</button></td>";?>
                <td bgcolor="#cccccc" style="height: 10px">
                    <Button type = "button" style="background-color: lightyellow" Width="120px" onclick="window.location.href='selectcountry.php'">Other Country</button></td>

            </tr>
</table>