const countries = [
    { name: "Canada", continent: "North America", cities: ["Calgary","Montreal","Toronto"], photos: ["canada1.jpg","canada2.jpg","canada3.jpg"] },
    { name: "United States", continent: "North America", cities: ["Boston","Chicago","New York","Seattle","Washington"], photos: ["us1.jpg","us2.jpg"] },
    { name: "Italy", continent: "Europe", cities: ["Florence","Milan","Naples","Rome"], photos: ["italy1.jpg","italy2.jpg","italy3.jpg","italy4.jpg","italy5.jpg","italy6.jpg"] },
    { name: "Spain", continent: "Europe", cities: ["Almeria","Barcelona","Madrid"], photos: ["spain1.jpg","spain2.jpg"] }
];


function InnerDiv(k){

  let inDiv=document.createElement("div");
  inDiv.className="item";

  let h21=document.createElement("h2");
  let h31=document.createElement("h3");
  let h32=document.createElement("h3");

  let pa1=document.createElement("p");
  let ib1=document.createElement("div");
  ib1.className="inner-box";
  let ib2=document.createElement("div");
  ib2.className="inner-box";
  let bt=document.createElement("button");
  let ul=document.createElement("ul");




  let node1=document.createTextNode(countries[k].name);
  let node2=document.createTextNode(countries[k].continent);
  let node3=document.createTextNode("Cities");
  let node4=document.createTextNode("Popular Photos");
  let node5=document.createTextNode("Visit");


  h31.appendChild(node3);
  ib1.appendChild(h31);
  ib1.appendChild(ul);
  for (var i = 0; i < countries[k].cities.length; i++) {

    let node=document.createTextNode(countries[k].cities[i]);
    let li=document.createElement("li");
    li.appendChild(node);
    ul.appendChild(li);

  }


  h32.appendChild(node4);
  ib2.appendChild(h32);
  for (var i = 0; i < countries[k].photos.length; i++) {

    let img=document.createElement("img");
    img.src="./images/"+countries[k].photos[i];
    img.className="photo";

    ib2.appendChild(img);

  }



  h21.appendChild(node1);
  pa1.appendChild(node2);
  bt.appendChild(node5);


  inDiv.appendChild(h21);
  inDiv.appendChild(pa1);
  inDiv.appendChild(ib1);
  inDiv.appendChild(ib2);
  inDiv.appendChild(bt);

  return inDiv;
}



window.onload=function(){

  let superDivAr= document.getElementsByTagName('div');

  let superDiv=superDivAr[0];

  let indiv1=InnerDiv(0);
  let indiv2=InnerDiv(1);
  let indiv3=InnerDiv(2);
  let indiv4=InnerDiv(3);




  superDiv.appendChild(indiv1);
  superDiv.appendChild(indiv2);
  superDiv.appendChild(indiv3);
  superDiv.appendChild(indiv4);





}
