<?php  
    class Script{

        public $id;
        static public $src = "";
        static public $BEGIN = "<script type='text/javaScript'>";  
        static public $END = "</script>";

        function __construct(){  
        } 
		static function begin($opt){ 	return  "<script type='text/javaScript'><!--  \n var ".$opt['name']." = function(".$opt['params']."){ ";} 
		static function end(){		return "};\n --></script>";} 
		static function wait($e){		return "<script type='text/javaScript'>".$e['name']."(".$e['params'].");</script>";} 
		static public function _script($options){   
			if(empty($options) || !is_array($options))
				return null; 
			if(!isset($options['element']) || !isset($options['action']))
				return null;
			if(!isset($options['type']))
				$options['type'] = '_script';
			if(!isset($options['parameters']))
				$options['parameters']='';
			if(!isset($options['eventParameters']))
				$options['eventParameters']='';
			$p = array( 
				'name' => $options['type'].'Script_'.$options['name'].'_'.$options['action'],
				'params' => $options['parameters']
			);
			//script définition fonction
			$b = self::begin($p);			
			$b .= "$('".$options['element']."').".$options['action']."(function(".$options['eventParameters']."){".$options['code']."});";
			$b .= self::end();
			//script appel fonction
			$div = self::wait($p);
			return array($b,$div);
		}
		static public function _multi_script($array_options){
			if(empty($array_options) || !is_array($array_options))
				return null; 
			$list = array(); 
			foreach($array_options as $v){
				if(!isset($v['type']))
					$v['type'] = '_script';
				switch($v['type']){
					case '_query' : $t=self::_query($v);  break;
					default : $t=self::_script($v);  break;
				}
				
				$list['s'][]=$t[0]; 
				$list['d'][]=$t[1]; 
			} 
			return $list;
		}
		static public function _query($options){
			//require #toReload, "query, #element, #reponse , "method, "url
			if(!isset($options['query']) || !isset($options['element']) 
				|| !isset($options['reponse']) || !isset($options['method']) 
				|| !isset($options['url']))
				return null;
			//if(!isset($options['time'])) $options['time'] = '1000';

			$form = '';
			$method = 0;
			if(strtolower(trim($options['method']))=='post'){
				$method = 1;
				if(!isset($options['formID']))
					return null;
				$form .= '$form = $("#'.$options['formID'].'");' ;
				$form .= 'var $inputs = $form.find("input, select, button, textarea");';
				$form .= 'var serializedData = $form.serialize();';
				$form .= '$inputs.prop("disabled", true);';
				$options['query'] = 'serializedData';
			}
			$form .= "$.ajax({";
			$form .= "type : ".Functions::squote($options['method']).",";
			$form .= "url : ".Functions::squote($options['url']).",";
			$form .= "data : ".($method ==0 ? Functions::squote($options['query']) : $options['query']).",";
			$form .= "success : function(server_response){";
			if(isset($options['toReload']))
				$form .= "$('".$options['toReload']."').load(".Functions::squote($options['url']).");";			
			if(isset($options['reponse'])){
				if(!isset($options['time']))
					$form .= "$('".$options['reponse']."').html(server_response).fadeIn(2000);";
				else
					$form .= "$('".$options['reponse']."').html(server_response).fadeIn(2000).fadeOut(".$options['time'].");";
			}
				
			$form .= "}";
			$form .= "});";
			$options['code'] = $form.$options['code']; 
			if($method==1){
				$options['code'] .= ' $inputs.prop("disabled", false);';
			}
			return self::_script($options);
		}
        static public function _query_click($options){ // abandonné 
			$t = array(
					'type' => '_query',
					'action' => 'click',
					'element' => $options['element'],
					'name' => substr("sdsd",2,end),  
					'code' => '',  
					'toReload' => $options['toReload'],  
					'query' => $options['query'],  
					'reponse' => $options['reponse'],  
					'method' => 'POST',  
					'url' => $options['url'],  
					'time' => $options['time'],  
				);
		}
		
		static public function alert($msg){
			echo self::$BEGIN;
			echo "alert('$msg');";
			echo self::$END;
		
        }
        public function ajaxScript($options){
			echo self::$BEGIN;
			echo "alert('frfrfrr');";
			echo self::$END;
		
        }



    }


 ?>
