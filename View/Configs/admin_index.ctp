<div class="formulario_entrada">
<h2><?php echo __d('q3_config','Configuration');?></h2>

<?php if(empty($groups)):?>
<h4><?php echo __d('q3_config','No elements');?></h4>
<?php else:
foreach($groups as $group):
	if(!empty($group['Config'])):
$group_id=$group['ConfigGroup']['id'];
echo $this->Form->create('Config',array('action'=>'admin_save_options','id'=>'Config'.$group_id.'AdminSaveForm'));
?>
<fieldset class="configuracion">
<legend><?php echo $group['ConfigGroup']['name'];?></legend>
<ul>
<?php
$i=0;
foreach($group['Config'] as $config):?>
	<li>
<?php
	echo $this->Form->hidden('Config.'.$i.'.id',array('value'=>$config['id'],'id'=>'Config_'.$group_id.'_'.$i.'_id'));
		$atributos=str_split(strrev(sprintf('%8b',$config['editable'])));
		$options=array();
		if($atributos[1]!=1){
			$options['class']='campo_corto';
		}
		if($atributos[2]==1){
			$options['type']='password';
		}
		if($atributos[3]==1){
			$valores=explode(';',$config['opciones']);
			$options['options']=array_combine($valores,$valores);
		}
		if($atributos[4]==1){
			$options['options']=array(1=>__d('q3_config','Yes'),0=>__d('q3_config','No'));
		}

	echo $this->Form->input('Config.'.$i.'.value',array('label'=>$config['description'],'value'=>$config['value'],'id'=>'Config_'.$group_id.'_'.$i.'_value')+$options);
	$i++;

	if(!empty($config['sufijo'])):
		$clase_sufijo='sufijo';
		if($atributos[1]!=1){
			$clase_sufijo.=' sufijo_corto';
		}
	?>
	<div class="<?php echo $clase_sufijo;?>"><?php echo $config['sufijo'];?></div>
	<?php endif;?>
</li>
<?php endforeach;?>

</ul>
<div class="botones">
<?php echo $this->Form->button(__d('q3_config','Save'), array('type'=>'submit')); ?>
</div>
</fieldset>
<?php
echo $this->Form->end();
endif;
endforeach;
endif;
?>

</div>
