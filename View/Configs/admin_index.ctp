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
<fieldset class="configuration">
<legend><?php echo $group['ConfigGroup']['name'];?></legend>
<ul>
<?php
$i=0;
foreach($group['Config'] as $config):?>
	<li>
<?php
	echo $this->Form->hidden('Config.'.$i.'.id',array('value'=>$config['id'],'id'=>'Config_'.$group_id.'_'.$i.'_id'));
		$atributes=str_split(strrev(sprintf('%8b',$config['editable'])));
		$options=array();
		if($atributes[1]!=1){
			$options['class']='short_field';
		}
		if($atributes[2]==1){
			$options['type']='password';
		}
		if($atributes[3]==1){
			$values=explode(';',$config['options']);
			$options['options']=array_combine($values,$values);
		}
		if($atributes[4]==1){
			$options['options']=array(1=>__d('q3_config','Yes'),0=>__d('q3_config','No'));
		}

	echo $this->Form->input('Config.'.$i.'.value',array('label'=>$config['description'],'value'=>$config['value'],'id'=>'Config_'.$group_id.'_'.$i.'_value')+$options);
	$i++;

	if(!empty($config['suffix'])):
		$suffix_class='suffix';
		if($atributes[1]!=1){
			$suffix_class.=' short_suffix';
		}
	?>
	<div class="<?php echo $suffix_class;?>"><?php echo $config['suffix'];?></div>
	<?php endif;?>
</li>
<?php endforeach;?>

</ul>
<div class="buttons">
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
