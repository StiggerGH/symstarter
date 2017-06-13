<?$view->extend('::default/layout.html.php') ?>

<?
   $model=$this->container->get('app.model');
$opTypeKeys=array_keys($data['opTypes']);
?>

<div class="row">


   <div class="col-md-6">

      <form method="post" enctype=multipart/form-data>
         <div class="form-group">
            <label>Дата</label>
            <input type="date" class="form-control" name=form[date] value="<?=date('Y-m-d',$data['transaction']->getDate())?>">
         </div>

         <div class="form-group">
            <label>Сумма</label>
            <input type="text" class="form-control" name=form[summ]  value="<?=$data['transaction']->getSumm()?>">
         </div>

         <div class="form-group">
            <label>Тип</label>
            <select id="optype" name=form[type] class="form-control">
               <? foreach ($data['opTypes'] as $k=>$v):?>
               <option <?=$data['transaction']->getType()==$k?'selected':""?> value="<?=$k?>"><?=$v?></option>
               <? endforeach;?>
            </select>    
         </div>

         <div id="ops<?=$opTypeKeys[0]?>" class="form-group">
            <label>Приходная операция</label>
            <select name=form[inboundType] class="form-control">
               <? foreach ($data['inboundTypes'] as $k=>$v):?>
               <option <?=$data['transaction']->getSubType()==$k?'selected':""?> value="<?=$k?>"><?=$v?></option>
               <? endforeach;?>
            </select>    
         </div>

         <div id="ops<?=$opTypeKeys[1]?>" class="form-group">
            <label>Расходная операция</label>
            <select name=form[outboundType] class="form-control">
               <? foreach ($data['outboundTypes'] as $k=>$v):?>
               <option <?=$data['transaction']->getSubType()==$k?'selected':""?> value="<?=$k?>"><?=$v?></option>
               <? endforeach;?>
            </select>    
         </div>

         <div class="form-group">
            <label>Описание</label>
            <input type="text" class="form-control" name=form[description]  value="<?=$data['transaction']->getDescription()?>">
         </div>

         <button type="submit" name=form[submit][ok] class="btn btn-default">Сохранить</button>
         <button type="submit" name=form[submit][apply] class="btn btn-default">Применить</button>
         <button type="submit" name=form[submit][cancel] class="btn btn-default">Отмена</button>
      </form>

   </div>
</div>

<script>

   $(function(){
      var opIn=<?=$opTypeKeys[0]?>;
      var opOut=<?=$opTypeKeys[1]?>;

      function changeOp(sel){
         $('#ops1').hide();
         $('#ops2').hide();

         $('#ops'+sel).show();

      }

      $('#optype').on('change', function(e){
         changeOp($('#optype').val());
      })

      changeOp(<?=$data['transaction']->getType()?>);

   });

</script>
