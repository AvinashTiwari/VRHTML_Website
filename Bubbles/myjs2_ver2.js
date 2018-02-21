var scene = document.querySelector('a-scene');

 for (i = 0; i < 100; i++) {

 var sphere = document.createElement('a-sphere');
     
     //update July 2017 
     var curves = document.createElement('a-curve'); 
     curves.setAttribute('id',"track"+ i);
    scene.appendChild(curves);

     //generate 3 random variables values for the random positions
    var posx = 10*Math.random();
    var posy = 10*Math.random();
    var posz = 10*Math.random();

    //generate 6 random variables values for the random curves
    var x1 = 10*Math.random(); 
    var y1 = 10*Math.random();
    var z1 = 10*Math.random();

    var x2 = 10*Math.random();
    var y2 = 10*Math.random();
    var z2 = 10*Math.random();

    //generate random variable value for the random radii
    var rad = 2*Math.random();

    //generate random variable value for the random color
    var col = Math.floor(16777215*Math.random()); 

    // set the attributes for the Sphere
    sphere.setAttribute('radius', rad.toString());
    sphere.setAttribute('color', '#'+col.toString(16));
    sphere.setAttribute('opacity','0.5');
    sphere.setAttribute('position', posx + " " + posy + " " +  posz); // posx,posy,posz will set initial position of the spheres 
     
//update July 2017 
     var curve_point1 = document.createElement('a-curve-point');
     var curve_point2 = document.createElement('a-curve-point');
//update July 2017 
     curve_point1.setAttribute('position', x1 + " " + y1 + " " + z1);
     curve_point2.setAttribute('position', x2 + " " + y2 + " " + z2);

     // appendChild to curves //update July 2017 
     curves.appendChild(curve_point1);
     curves.appendChild(curve_point2);

  


     

    //update July 2017 
     sphere.setAttribute('alongpath',"curve: #track"+ i+"; dur:2000;loop:true");
  


        scene.appendChild(sphere);

}