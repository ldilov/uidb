<?php
require_once(__DIR__."/../functions.php");
verify_admin("..");

?>
<div style="width: 900px; margin: 0 auto;">
	<form method="post" action="modules/course_add.php">
	<div class="form-group row">
	  <label for="name" class="col-2 col-form-label">Име на курс</label>
	  <div class="col-10">
		<input class="form-control" type="text"  id="name">
	  </div>
	</div>
    <script src="../js/typeahead.bundle.js"></script>
    <script>
	jQuery(document).ready(function(){
	var engine = new Bloodhound({
    remote: {
        url: 'search.php?key=%QUERY',
        wildcard: '%QUERY'
    },
	 datumTokenizer: Bloodhound.tokenizers.whitespace('key'),
    queryTokenizer: Bloodhound.tokenizers.whitespace
	});

    $('input.typeahead').typeahead(null, {
        name: 'typeahead',
        source: engine.ttAdapter(),
		displayKey:'id',
	    templates: {
            empty: [
                '<div class="list-group search-results-dropdown"><div class="list-group-item">Няма намерени резултати.</div></div>'
            ],
            header: [
                '<div class="list-group search-results-dropdown">'
            ],
            suggestion: function (data) {
                return '<p class="list-group-item">' + data.lecturer +  '</p>'
			}
        }

    });
	});
    </script>
	<div class="form-group row">
	  <label for="teacher" class="col-2 col-form-label">Преподавател</label>
	  <div class="col-10">
		<input type="text" name="teacher" placeholder=" Търсене по първо име" class="typeahead tt-query form-control" autocomplete="off" spellcheck="false">
	  </div>
	</div>
	<div class="form-group row">
	  <label for="credits" class="col-2 col-form-label">Кредити</label>
	  <div class="col-10">
		<input class="form-control" type="number" id="credits">
	  </div>
	</div>
	<div class="form-group row">
	  <label for="limit" class="col-2 col-form-label">Лимит</label>
	  <div class="col-10">
		<input class="form-control" type="number" value="32" id="limit" max="120">
	  </div>
	</div>
	<div class="form-group row">
	  <label for="time" class="col-2 col-form-label">Час</label>
	  <div class="col-10">
		<input class="form-control" name="time" type="text" value="13:45:00" id="time">
	  </div>
	</div>
	<div class="form-group row">
	  <label for="room" class="col-2 col-form-label">Зала</label>
	  <div class="col-10">
		<input class="auditorium" type="text" style="width:100%" id="room" pattern="[0-9]{1,4}">
	  </div>
	</div>
	<div class="form-group">
		<label for="programs">Програми</label>
		   <select multiple class="form-control" id="programs">
		   <?php
		   $query = "SELECT id, name FROM programs";
		   try{
			  $result = $link->query($query);
		   } catch (Exception $e){
			   echo $e->getMessage();
		   }
		   while($row = $result->fetch_assoc()){
		   ?>
		   <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
		   <?php } ?>
		</select>
	</div>

	<div class="form-group">
	  <label for="comment">Описание</label>
	  <script type="text/javascript" src="../plugins/ckeditor/ckeditor.js"></script>
	  <textarea name="description" style="width: 100%;" maxlength="1500" spellcheck="true" lang="bg" id="editor"></textarea>
	  <script type="text/javascript"> CKEDITOR.replace( 'editor' );</script>
	</div>
	<button type="submit" class="btn btn-success">Запиши</button>
</div>
<br><br>

