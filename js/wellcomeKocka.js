
  var colors = [0xff0000, 0x00ff00, 0x0000ff];



  // all units in mm
  var initScene = function () {
    var modelDiv = document.getElementById("wellcomeModelDiv");

    scene = new THREE.Scene();
    renderer = new THREE.WebGLRenderer({
      alpha: true
    });

    renderer.setClearColor(0x000000, 0);
    renderer.setSize(modelDiv.clientWidth, modelDiv.clientHeight);
    
    

  /*  window.renderer.domElement.style.position = 'fixed';
    window.renderer.domElement.style.top = 0;
    window.renderer.domElement.style.left = 0;
    window.renderer.domElement.style.width = '100%';
    window.renderer.domElement.style.height = '100%';*/

    modelDiv.appendChild(renderer.domElement);

    var directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
    directionalLight.position.set( 0, 0.5, 1 );
    scene.add(directionalLight);

    camera = new THREE.PerspectiveCamera(45, modelDiv.clientWidth / modelDiv.clientHeight, 1, 1000);
    camera.position.fromArray([0, 100, 500]);
    camera.lookAt(new THREE.Vector3(0, 160, 0));

    window.addEventListener('resize', function () {

      camera.aspect =  modelDiv.clientWidth / modelDiv.clientHeight;
      camera.updateProjectionMatrix();
     
      
      renderer.render(scene, camera);

    }, false);

    scene.add(camera);


   // var geometry = new THREE.SphereGeometry(100,32,32);
    var geometry = new THREE.BoxGeometry(100,100,100);
    var material = new THREE.MeshPhongMaterial( { map: THREE.ImageUtils.loadTexture('img/dobrodosli.png') } );
    window.cube = new THREE.Mesh(geometry, material);
    cube.position.set(0,200,0);
    cube.castShadow = true;
    cube.receiveShadow = true;


    scene.add(cube);
    

    renderer.render(scene, camera);
  };

  initScene();

  var rotateCube = function(){
    //cube.rotation.x += 0.01;
    cube.rotation.y -= 0.02;
    renderer.render(scene, camera);

    window.requestAnimationFrame(rotateCube);
  };

  rotateCube();


 /* var material = new THREE.MeshPhongMaterial({
          color: 0xdddddd
      });
      var textGeom = new THREE.TextGeometry( 'Wellcome!', {
          font: 'source sans pro' // Must be lowercase!
      });
      var textMesh = new THREE.Mesh( textGeom, material );

      scene.add( textMesh );*/


