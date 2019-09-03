<div class="row">
    <div class="col-sm-12">
        <form action="#" id="form-serach-consumos" class="row">
            <div class="form-group col-sm-9">
                <input type="text" class="form-control" id="rangoFecha" name="rangoFecha" autocomplete=off>
            </div>
            <div class="form-group col-sm-3">
                <button type="submit" class="btn btn-primary btn-block"> <i class="fa fa-search"></i> Buscar </button>
            </div>
            
        </form>
    </div>

    <div class="col-sm-12">

        <div style="width: 100%; height: 400px; overflow-y: scroll;">
            <table class="table table-condensed table-bordered" style="margin-bottom:0;">
                <thead>
                    <tr class="bg-gray">
                        <td>Codigo</td>
                        <td>Nombre</td>
                        <td>Cantidad</td>
                    </tr>
                </thead>
                <tbody id="tbody-consumos">
                    
                </tbody>
            </table>
        </div>

        
        
    </div>

    <div class="col-sm-12">
        <div class="pull-right">
            <a href="#" class='btn btn-success btn-pull-consumos'> <i class="fa fa-pull"></i> PULL</a>
        </div>
    </div>
</div>

