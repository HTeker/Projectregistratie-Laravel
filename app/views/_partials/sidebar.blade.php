<div class="uk-panel uk-panel-box">
    <h3 class="text-center">Deadline nadert!</h3>
        <div id="nadert"></div>
    <hr class="uk-grid-divider">
    <li>{{ HTML::link('deadlines/approach', 'Meer')}}</li>
</div>
<div class="uk-panel uk-panel-box">
    <h3 class="text-center">Deadline verlopen!</h3>
        <div id="verlopen"></div>
    <hr class="uk-grid-divider">
    <li>{{ HTML::link('deadlines/expire', 'Meer')}}</li>
</div>

@section('sidebar-script')
    <script>
        var vandaag = new Date();
        var dd = vandaag.getDate();
        var mm = vandaag.getMonth()+1; //January is 0!
        var yyyy = vandaag.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        }

        var begin = yyyy+"-"+mm+"-"+dd;

        var tweeWeken = new Date();
        tweeWeken.setDate(vandaag.getDate()+14);
        var dd = tweeWeken.getDate();
        var mm = tweeWeken.getMonth()+1; //January is 0!
        var yyyy = tweeWeken.getFullYear();

        if(dd<10) {
            dd='0'+dd
        } 

        if(mm<10) {
            mm='0'+mm
        }

        var eind = yyyy+"-"+mm+"-"+dd;

        $(document).ready(function(){
            $.ajax({
                type: 'GET',
                url: '/deadline/nadert',
                dataType: 'json',
                data: {begin:begin,
                       eind:eind},
                success: function(data){
                    
                    var msg = '';
                    if(data.length != 0){
                        $.each(data, function(){
                            var leerlingNaam = this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam;

                            msg += "<p><a href='#'>" + leerlingNaam + "</a> <br><span class='pt10'>" + this.project + "<span class='place-right'>" + this.deadline + "</span></span></p>"
                        });
                    }else{
                        msg += "Geen naderende deadlines <br> <small>(2 weken)</small>";
                    }

                    $('#nadert').html(msg);
                }
            });

            $.ajax({
                type: 'GET',
                url: '/deadline/verlopen',
                dataType: 'json',
                data: {vandaag:begin},
                success: function(data){
                    var msg = '';
                    if(data.length != 0){
                        $.each(data, function(){
                            var leerlingNaam = this.voornaam + " " + this.tussenvoegsel + " " + this.achternaam;

                            msg += "<p><a href='#'>" + leerlingNaam + "</a> <br><span class='pt10'>" + this.project + "<span class='place-right'>" + this.deadline + "</span></span></p>"
                        });
                    }else{
                        msg += "Geen verlopen deadlines";
                    }

                    $('#verlopen').html(msg);
                }
            });
        });

        Date.prototype.addDays = function(days) {
            this.setDate(this.getDate()+days);
        }
    </script>
@stop