<?php
	class Router{ 
		
		static $routes = array();
		
		/*
		* permet de parser une url
		* @param $url : url à parser
		* @return  : tableau contenant les paramètres
		*/
		static function parse($url,$request){ 
			$url = trim($url,'/'); // retire les / avant et après, pour ne pas avoir de contenu vide	
			//Functions::debug($url);
			// on vérifie si l'url match avec une des règles ...  
			foreach(Router::$routes as $v){ 
				 //Functions::debug($v['action']);
				// Functions::debug($v['catcher']);
				// Functions::debug($v);
				if(preg_match($v['catcher'],$url,$match)){
					//Functions::debug($match);
					$request->controller = $v['controller'];
					$request->action = $v['action'];    
					$request->params = array();
					foreach($v['params'] as $k=>$v){
						$request->params[$k] = $match[$k];
					} 
					return $request;
				}
			}
			//... sinon on segmente l'url 
			$params = explode('/',$url);   //Functions::debug($params);
			if(sizeof($params)>=1 && !empty($params[0])){
				$request->controller = $params[0];
				$request->action = isset($params[1]) ? $params[1] : 'index';
				$request->params = array_slice($params,2);  
			}else{
				$request->controller = "accueil";
				$request->action = 'index';		 	
			} 
			
			return false;
		}
		static function connect($redir,$url){
			$r = array();
			$r['params'] = array();
			$r['redir'] = $redir;
			$r['origin'] = '/'.str_replace('/','\/',$url).'/'; 
			$r['origin'] = preg_replace('/([a-zA-Z0-9]+):([^\/])/','${1}:(?P<${1}>${2})',$r['origin']);
			
			$params = explode('/',$url);
			foreach($params as $k => $v){
				if(strpos($v,':')){
					$p = explode(':',$v); 
					$r['params'][$p[0]] = $p[1];
				}else{
					if($k==0)
						$r['controller'] = $v;
					elseif($k==1)
						$r['action'] = $v;
				}
			}
			
			$r['catcher'] = $redir;
			foreach($r['params'] as $k => $v){ 
				$r['catcher'] = str_replace(":$k","(?P<$k>$v)",$r['catcher']);
			}
			$r['catcher'] = '/'.str_replace('/','\/',$r['catcher']).'/';
			
			self::$routes[] = $r; 			 
		}
		static function url($url){  
			foreach(self::$routes as $v){  
				if(preg_match($v['origin'],$url,$match)){  
					foreach($match as $k => $w){
						if(!is_numeric($k)){
							$v['redir'] = str_replace(":$k",$w,$v['redir']);
						}
					} 
					//Functions::debug($v['redir']);
					return URL_TO_REMOVE_NO_REGEX.$v['redir'];
				} 
			}
			return URL_TO_REMOVE_NO_REGEX.DS.$url;
		}
	}
?>