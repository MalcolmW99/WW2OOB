<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<style type="text/css">@import url(css/jquery.datatables_themeroller.css);</style>
<style type="text/css">@import url(css/styles.css);</style>
<script type="text/javascript" language="javascript" src="js/jquery.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery-ui.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.dataTables.min.js"></script>

<script>
$(function() {
      $('#mytable').dataTable( {
	  "oLanguage": {
            "sZeroRecords": "There are no records that match your search criterion",
            "sInfoEmpty": "Showing 0 to 0 of 0 records",
            "sInfoFiltered": "(filtered from _MAX_ total records)"
        }, 
	  sPaginationType: "full_numbers"
   });
});
</script>

<body>
<div id="container" style="width:800px; margin:0 auto;">
<h2 class = 'centre'>Test of dataTables</h2>
<table id="mytable" style="margin:20px 0px 20px 0px;">
<thead>
<tr><th>One</th><th>Two</th></tr>
</thead>
<tbody>
<tr><td>1</td><td>2</td></tr>
<tr><td>11</td><td>22</td></tr>
<tr><td>12</td><td>23</td></tr>
<tr><td>13</td><td>24</td></tr>
<tr><td>14</td><td>22</td></tr>
<tr><td>11</td><td>22</td></tr>
<tr><td>12</td><td>22</td></tr>
<tr><td>13</td><td>22</td></tr>
<tr><td>14</td><td>22</td></tr>
<tr><td>11</td><td>22</td></tr>
<tr><td>11</td><td>29</td></tr>
<tr><td>1</td><td>22</td></tr>
</tbody>
</table>
</div>
<br>
<p class=centre><Button type = 'button' onclick="window.location.href='index_KEEP.php'">Main Site</button></p>
</body>
</html>