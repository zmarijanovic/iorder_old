<div class="fitem">{{ Form::label('cname', 'Naziv kompanije',array('style'=>'width:95%')) }} {{
		Form::text('cname',null,array('class'=>'easyui-textbox','style'=>'width:95%',
		'required'=>'true')) }}</div>
		
				<!-- FormExtra -->
            @yield('formextra')
		
	<div class="fitem">{{ Form::label('pname', 'Kontakt Osoba',array('style'=>'width:95%')) }} {{
		Form::text('pname',null,array('class'=>'easyui-textbox','style'=>'width:95%'))
		}}</div>
	<div class="fitem">{{ Form::label('email', 'Email',array('style'=>'width:95%')) }} {{
		Form::text('email',null,array('class'=>'easyui-textbox','style'=>'width:95%','validType'=>'email'))
		}}</div>
	<div class="fitem">{{ Form::label('phone', 'Telefon',array('style'=>'width:95%')) }} {{
		Form::text('phone',null,array('class'=>'easyui-textbox','style'=>'width:95%'))
		}}</div>
	<div class="fitem">{{ Form::label('mobile', 'Mobitel',array('style'=>'width:95%')) }} {{
		Form::text('mobile',null,array('class'=>'easyui-textbox','style'=>'width:95%'))
		}}</div>

	<div class="fitem">{{ Form::label('fax', 'Fax',array('style'=>'width:95%')) }} {{
		Form::text('fax',null,array('class'=>'easyui-textbox','style'=>'width:95%')) }}</div>
	<div class="fitem">{{ Form::label('street', 'Ulica',array('style'=>'width:95%')) }} {{
		Form::text('street',null,array('class'=>'easyui-textbox','style'=>'width:95%')) }}</div>
	<div class="fitem">{{ Form::label('zip', 'Poštanski broj',array('style'=>'width:95%')) }} {{
		Form::text('zip',null,array('class'=>'easyui-textbox','style'=>'width:95%')) }}</div>
	<div class="fitem">{{ Form::label('city', 'Grad',array('style'=>'width:95%')) }} {{
		Form::text('city',null,array('class'=>'easyui-textbox','style'=>'width:95%')) }}</div>
	<div class="fitem">{{ Form::label('country', 'Država',array('style'=>'width:95%')) }} {{
		Form::text('country',null,array('class'=>'easyui-textbox','style'=>'width:95%')) }}</div>
	<div class="fitem">{{ Form::label('web', 'Web',array('style'=>'width:95%')) }} {{
		Form::text('web',null,array('class'=>'easyui-textbox','style'=>'width:95%','validType'=>'url')) }}</div>
	<div class="fitem">{{ Form::label('notes', 'Zabilješke',array('style'=>'width:95%')) }} {{
		Form::text('notes',null,array('class'=>'easyui-textbox','multiline'=>'true','style'=>'width:95%; height: 140px'))
		}}</div>


