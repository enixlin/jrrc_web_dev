<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <!--  引入extjs库-->
    <!--
    <link rel="stylesheet" type="text/css" href="/jrrc_web_dev/web/Extjs/theme-classic/resources/theme-classic-all.css" />
    <link rel="stylesheet" type="text/css" href="/Extjs/theme-neptune/resources/theme-neptune-all.css" />
    -->
    <link rel="stylesheet" type="text/css" href="/jrrc_web_dev/web/Extjs/theme-triton/resources/theme-triton-all.css" />
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext.js"></script>
    <!-- <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext-all-debug.js"></script> -->
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/ext-all.js"></script> 
    <!-- 加载EXTjs中文配置文件 -->
    <script type="text/javascript" src="/jrrc_web_dev/web/Extjs/locale/locale-zh_CN-debug.js"></script>
    <title>欢迎使用国际业务信息查询系统</title>

    <style>
			body {
				background-color: #ffffff;
				margin: 0px;
				overflow: hidden;
			}
			a {
				color:#0078ff;
			}
		</style>


</head>

<body>


        <script src="/jrrc_web_dev/web/build/three.js"></script>

		<script src="/jrrc_web_dev/web/js/renderers/Projector.js"></script>
		<script src="/jrrc_web_dev/web/js/renderers/CanvasRenderer.js"></script>
        <script src="/jrrc_web_dev/web/js/libs/stats.min.js"></script>
        

        <script src="js/renderers/Projector.js"></script>
		<script src="js/renderers/CanvasRenderer.js"></script>

		<script src="js/libs/stats.min.js"></script>
		<script src="js/libs/tween.min.js"></script>

		<script>
			var container, stats;
			var camera, scene, renderer, particle;
			var mouseX = 0, mouseY = 0;
			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;
			init();
			animate();
			function init() {
				container = document.createElement( 'div' );
				document.body.appendChild( container );
				camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 1, 5000 );
				camera.position.z = 1000;
				scene = new THREE.Scene();
				scene.background = new THREE.Color( 0x000040 );
				var material = new THREE.SpriteMaterial( {
					map: new THREE.CanvasTexture( generateSprite() ),
					blending: THREE.AdditiveBlending
				} );
				for ( var i = 0; i < 1000; i++ ) {
					particle = new THREE.Sprite( material );
					initParticle( particle, i * 10 );
					scene.add( particle );
				}
				renderer = new THREE.CanvasRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				container.appendChild( renderer.domElement );
				stats = new Stats();
				container.appendChild( stats.dom );
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				document.addEventListener( 'touchstart', onDocumentTouchStart, false );
				document.addEventListener( 'touchmove', onDocumentTouchMove, false );
				//
				window.addEventListener( 'resize', onWindowResize, false );
			}
			function onWindowResize() {
				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;
				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();
				renderer.setSize( window.innerWidth, window.innerHeight );
			}
			function generateSprite() {
				var canvas = document.createElement( 'canvas' );
				canvas.width = 16;
				canvas.height = 16;
				var context = canvas.getContext( '2d' );
				var gradient = context.createRadialGradient( canvas.width / 2, canvas.height / 2, 0, canvas.width / 2, canvas.height / 2, canvas.width / 2 );
				gradient.addColorStop( 0, 'rgba(255,255,255,1)' );
				gradient.addColorStop( 0.2, 'rgba(0,255,255,1)' );
				gradient.addColorStop( 0.4, 'rgba(0,0,64,1)' );
				gradient.addColorStop( 1, 'rgba(0,0,0,1)' );
				context.fillStyle = gradient;
				context.fillRect( 0, 0, canvas.width, canvas.height );
				return canvas;
			}
			function initParticle( particle, delay ) {
				var particle = this instanceof THREE.Sprite ? this : particle;
				var delay = delay !== undefined ? delay : 0;
				particle.position.set( 0, 0, 0 );
				particle.scale.x = particle.scale.y = Math.random() * 32 + 16;
				new TWEEN.Tween( particle )
					.delay( delay )
					.to( {}, 10000 )
					.onComplete( initParticle )
					.start();
				new TWEEN.Tween( particle.position )
					.delay( delay )
					.to( { x: Math.random() * 4000 - 2000, y: Math.random() * 1000 - 500, z: Math.random() * 4000 - 2000 }, 10000 )
					.start();
				new TWEEN.Tween( particle.scale )
					.delay( delay )
					.to( { x: 0.01, y: 0.01 }, 10000 )
					.start();
			}
			//
			function onDocumentMouseMove( event ) {
				mouseX = event.clientX - windowHalfX;
				mouseY = event.clientY - windowHalfY;
			}
			function onDocumentTouchStart( event ) {
				if ( event.touches.length == 1 ) {
					event.preventDefault();
					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;
				}
			}
			function onDocumentTouchMove( event ) {
				if ( event.touches.length == 1 ) {
					event.preventDefault();
					mouseX = event.touches[ 0 ].pageX - windowHalfX;
					mouseY = event.touches[ 0 ].pageY - windowHalfY;
				}
			}
			//
			function animate() {
				requestAnimationFrame( animate );
				render();
				stats.update();
			}
			function render() {
				TWEEN.update();
				camera.position.x += ( mouseX - camera.position.x ) * 0.05;
				camera.position.y += ( - mouseY - camera.position.y ) * 0.05;
				camera.lookAt( scene.position );
				renderer.render( scene, camera );
			}
		</script>

		




</body>

</html>
<script>
    Ext.onReady(function() {
        // 取得用户
        var Users = Ext.create('Ext.data.Store', {
            fields: ['id', 'name'],
            proxy: {
                type: 'ajax',
                url: '/jrrc_web_dev/web/user/get-available-users-names'
            }
        });


        // 登录信息
        var LoginForm = Ext.create('Ext.form.Panel', {
            width: 300,
            height: 300,
            id: 'LoginForm',
            margin: '20 30 10 50',
            border: false,
            items: [{
                xtype: 'combobox',
                fieldLabel: '用户名',
                id: 'UID',
                name: 'id',
                store: Users,
                displayField: 'name',
                valueField: 'id'
            }, {
                xtype: 'textfield',
                fieldLabel: '密码',
                id: 'password',
                name: 'password',
                inputType: 'password'

            }, {
                xtype: 'button',
                icon: '/jrrc_web_dev/web/icons/door_in.png',
                id: 'btn_submit',
                text: '登   &nbsp&nbsp 录',
                width: 170,
                margin: '10 0 10 105',
                listeners: {
                    click: {
                        fn: function() {
                            Ext.getCmp('btn_submit').setDisabled(true);
                            submit();
                        }

                    }
                }
            }]

        }).show();

        // 登录窗口
        var LoginWin = Ext.create('Ext.window.Window', {
            width: 400,
            height: 200,
            icon: '/jrrc_web_dev/web/icons/world/world.png',
            title: '欢迎使用国际业务信息查询工具--用户登录',
            items: [LoginForm]
        }).show();

        // 处理登录事件
        function submit() {
            // 验证用户输入信息是否齐全
            var UID = Ext.getCmp('UID').value;
            var password = Ext.getCmp('password').value;
            if (UID != "" && password != "") {
                // console.log('用户：' + UID + " 密码：" + password);
            } else {
                // alert("用户名或密码请【填写完整】，请重新输入");
                showError("用户名或密码请【填写完整】，请重新输入");
                return;
            }
            // 提交请求
            Ext.Ajax.request({
                url: '/users/valitPassword',
                method: 'post',
                params: {
                    'id': UID,
                    'password': password
                },
                success: function(response, opts) {
                    var result = eval("(" + response.responseText + ")"); //转换为json对象 
                    if (result.name) {
                        window.location.href = "/main/"
                    } else {
                        showError("【用户名或密码有误】，请检查后重新输入");
                    }
                },
                failure: function(response, opts) {
                    alert("登录有误，出错信息：" + response.responseText);
                }
            });
        }

        /* 
        显示所有错           
        */
        function showError(msg) {
            Ext.create('Ext.window.Window', {
                title: "输入信息出错",
                modal: true,
                icon: '/icons/error.png',
                width: 300,
                height: 100,
                items: {
                    xtype: 'label',
                    text: msg,
                    margin: '20 10 10 10'
                },
                listeners: {
                    close: {
                        fn: function() {
                            Ext.getCmp('btn_submit').setDisabled(false);
                        }
                    }
                }
            }).show();
        }

        var body = Ext.getBody();
        body.on({
            keypress: function(e, t, eOpts) {
                var st = Ext.getCmp('btn_submit').disabled;
                if (st == true) {
                    return;
                }
                if (e.getKey() === Ext.event.Event.ENTER) {
                    Ext.getCmp('btn_submit').setDisabled(true);
                    submit();

                }
            }
        });

    });
</script>
