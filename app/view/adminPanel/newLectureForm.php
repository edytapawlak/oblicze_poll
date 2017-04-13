<form class="form-horizontal">
<fieldset>

<!-- Form Name -->
<legend>Dodaj nowy referat</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureTitle">Tytuł</label>  
  <div class="col-md-4">
  <input id="newLectureTitle" name="newLectureTitle" placeholder="tytuł nowego referatu" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureAbstract">Abstrakt</label>
  <div class="col-md-4">                     
    <textarea class="form-control" id="newLectureAbstract" name="newLectureAbstract"></textarea>
  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureAuthors">Autorzy</label>
  <div class="col-md-4">
    <select id="newLectureAuthors" name="newLectureAuthors" class="form-control" multiple="multiple">
      <option value="1">Option one</option>
      <option value="2">Option two</option>
    </select>
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureTime">Termin</label>
  <div class="col-md-4">
    <select id="newLectureTime" name="newLectureTime" class="form-control">
      <option value="1">Option one</option>
      <option value="2">Option two</option>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLecturePlace">Miejsce</label>  
  <div class="col-md-4">
  <input id="newLecturePlace" name="newLecturePlace" placeholder="" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureTags">Tagi</label>  
  <div class="col-md-4">
  <input id="newLectureTags" name="newLectureTags" placeholder="" class="form-control input-md" type="text">
  <span class="help-block">Przykład: #teoria_liczb #topologia</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="newLectureButton"></label>
  <div class="col-md-4">
    <button id="newLectureButton" name="newLectureButton" class="btn btn-primary">Dodaj</button>
  </div>
</div>

</fieldset>
</form>