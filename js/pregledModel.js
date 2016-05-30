   var loadmanager = new THREE.LoadingManager();
      loadmanager.onProgress=function(item,loaded,total){
        
      }

      var rekObj = null;
      var object2;
      var modelDiv = document.getElementById("pregledModelDiv");
      var scene;
      var camera;
      var renderer;
      var controls1;

      function animate1() {

        requestAnimationFrame( animate1);
        controls1.update();
        render();

      } 
      function render(){
                     // object1.rotation.y+=0.1;
        renderer.render( scene, camera );  
  
      }

    function setcontrols1(){
        controls1 = new THREE.OrbitControls(camera,renderer.domElement);
        controls1.addEventListener( 'change', render );
        controls1.enableDamping = true;
        controls1.dampingFactor = 0.25;
        controls1.enableZoom = false;
    }
    

    function init(){

      
            scene = new THREE.Scene();
           
            camera = new THREE.PerspectiveCamera( 70, modelDiv.clientWidth / modelDiv.clientHeight, 0.001, 90 );

            renderer = new THREE.WebGLRenderer({ alpha: true });

            camera.position.z=9.3;
            window.addEventListener('resize', function () {

            camera.aspect = modelDiv.clientWidth / modelDiv.clientHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(modelDiv.clientWidth,modelDiv.clientHeight);
            renderer.render(scene, camera);
          
          }, false);
            //camera.position.z=2.5;
            scene.fog = new THREE.Fog( 0xaaaaaa, 0.001, 80 );

            renderer.setSize( modelDiv.clientWidth, modelDiv.clientHeight);
            renderer.setClearColor( 0xffffff, 1);
            modelDiv.appendChild(renderer.domElement);

            modelDiv.addEventListener('mouseout',function(){controls1.reset();});

            var spotLight = new THREE.PointLight( 0xeeffff,3,220,2 );
              spotLight.position.set( 0, 0, 50 );
              spotLight.castShadow = false;
              spotLight.shadowMapWidth = 512;
              spotLight.shadowMapHeight = 512;

              spotLight.shadowCameraNear = 0.01;
              spotLight.shadowCameraFar = 90;
              spotLight.shadowCameraFov = 70;

            scene.add( spotLight );

            var spotLight2 = new THREE.PointLight( 0xeeffff,4,220,3 );
              spotLight2.position.set( 0,0, -50 );
              spotLight2.castShadow = false;
              spotLight2.shadowMapWidth = 512;
              spotLight2.shadowMapHeight = 512;

              spotLight2.shadowCameraNear = 0.01;
              spotLight2.shadowCameraFar = 90;
              spotLight2.shadowCameraFov = 70;

            scene.add(spotLight2);            

            var loader1 = new THREE.OBJMTLLoader(loadmanager);
            // load a resource
            
            var putObj=  document.getElementById("putObj").textContent;
            var putMtl=  document.getElementById("putMtl").textContent;
            

            loader1.load(
             putObj,
             putMtl,
              function(object12){
                object2=object12;
                object2.scale.set(5,5,5);
                object2.position.x=-1;
              object2.rotation.x=3.14/2;
                //object.position.z=-1;
               scene.add(object2);              
              });
    };        

    init();
    setcontrols1();
    animate1(); 




