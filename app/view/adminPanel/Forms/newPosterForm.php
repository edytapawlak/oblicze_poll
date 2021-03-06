<?php
class newPosterForm {
    private $users;
    private $schedules;
    
    function __construct($users, $schedules) {
        $this->users = $users;
        $this->schedules = $schedules;
    }
    
    public function show() {
?>
<form class="form-horizontal" method="post">
<fieldset>

<!-- Form Name -->
<legend>Dodawanie plakatów</legend>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterTitle">Tytuł</label>  
  <div class="col-md-9">
  <input id="newPosterTitle" name="newPosterTitle" placeholder="tytuł nowego plakatu" class="form-control input-md" type="text">
    
  </div>
</div>

<!-- Textarea -->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterAbstract">Abstrakt</label>
  <div class="col-md-9">                     
    <textarea class="form-control" id="newPosterAbstract" name="newPosterAbstract"></textarea>
  </div>
</div>

<!-- Select Multiple -->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterAuthors">Autorzy</label>
  <div class="col-md-9">
    <select id="newPosterAuthors" name="newPosterAuthors[]" class="form-control" multiple="multiple">
    <?php 
    foreach ($this->users as $user) {
        $id = $user->getID();
        $fullname = $user->getFullName();
        $email = $user->getEmail();
        echo '<option value="' . $id . '">' . $fullname . ", " . $email . "</option>";
    }
    ?>
    </select>
      <span class="help-block">Aby jednocześnie zaznaczyć kilku autorów, przytrzymaj <kbd>Ctrl</kbd></span>  
  </div>
</div>

<!-- Select Basic -->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterTime">Termin</label>
  <div class="col-md-9">
    <select id="newPosterTime" name="newPosterTime" class="form-control">
    <?php 
    foreach ($this->schedules as $schedule) {
        $id = $schedule->getID();
        $start = $schedule->getStart("H:i");
        $end = $schedule->getEnd("H:i");
        $date = $schedule->getDate("d/m");
        $place = $schedule->getPlace();
        $full = 'godzina ' . $start . ' - ' . $end . ', miejsce: ' . $place . ', dzień: ' . $date;
        echo '<option value="' . $id . '">' . $full . "</option>";
    }
    ?>
    </select>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterTags">Tagi</label>  
  <div class="col-md-9">
  <input id="newPosterTags" name="newPosterTags" placeholder="" class="form-control input-md" type="text">
  <span class="help-block">Przykład: #teoria_liczb #topologia</span>  
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-2 control-label" for="newPosterButton"></label>
  <div class="col-md-9">
    <button id="newPosterButton" class="btn btn-primary">Dodaj</button>
  </div>
</div>

</fieldset>
</form>
<?php
    }
}