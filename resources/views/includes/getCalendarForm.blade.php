<br />
<form id="addAgendaForm" action="#" method="post" style="width:98%;">
    {{ csrf_field() }}
    <input type="hidden" name="secId" value="2">
    <div class="form-row">
          <div class="form-group col-md-11">
            <label for="inputPassword4"><b>Title</b></label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Enter Title" >
         </div>
    </div>


    <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputPassword4"><b>Time</b></label>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <input type="date" class="form-control" id="inputPassword4" name="date">
                </div>
                <div class="form-group col-md-2">
                    <input type="time" class="form-control" id="inputPassword4" name="date">
                </div>

                <div class="form-group col-md-1" style="text-align:center;">
                    <div style="margin-top:8px;">To</div>
                </div>

                <div class="form-group col-md-3">
                    <input type="date" class="form-control" id="inputPassword4" name="date">
                </div>
                <div class="form-group col-md-2">
                    <input type="time" class="form-control" id="inputPassword4" name="date">
                </div>



            </div>

         </div>
    </div>



    <div class="form-row">
          <div class="form-group col-md-11">
            <label for="inputPassword4"><b>Timezone</b></label>
            <select class="form-control subjects" name="subjectId">
                <option value="0" selected disabled>Select Timezone</option>
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
            </select>
     </div>
    </div>

    <div class="form-row">
          <div class="form-group col-md-11">
            <label for="inputPassword4"><b>Location</b></label>
            <input type="text" class="form-control" id="inputPassword4" placeholder="Enter Location" >
         </div>
    </div>

    <div class="form-row">
          <div class="form-group col-md-11">
            <label for="inputPassword4"><b>Event Body</b></label>
            <textarea  name="summary" rows="5" cols="20" class="form-control"></textarea>

        </div>
    </div>






    </form>
