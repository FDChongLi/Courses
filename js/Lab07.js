
function Contr() {
  this.cre = false;
  this.tableNumber = 0;
  this.in1HD = true;
  this.in2HD = true;
  this.btHD = true;
  this.select = 1 ;
  this.nowTable = -1;           //nowTableNum
  this.tableArray = new Array(1);
  this.attrShow = false;
  this.attrIn;
  this.attrValCheck;
  this.hasRow = 0;

  this.rowCreShow = false;
  this.rowCre;

  this.rowDelShow = false;
  this.rowDel;

  this.tabDelShow = false;
  this.tabDel;

  this.select=document.getElementById('select');
  this.select2=document.getElementById('s2');
  this.bt=document.getElementById('bt1');
  this.in1=document.getElementById('in1');
  this.in2=document.getElementById('in2');
  this.fm=document.getElementById('form');

  Contr.prototype.hid = function (ele) {
    ele.style.display="none";
  };

  Contr.prototype.newE = function (name,html) {
    var newEl = document.createElement(name);
    newEl.innerHTML = html ;
    return newEl;
  };

}

function Table(name,attr) {

  this.name = name;
  this.attr = attr;
  this.show = false;
  this.table;
  this.option;
  this.del = false;
  this.row = new Array(0);
  this.rowContain = new Array(0);

}

var select=document.getElementById('select');
var select2=document.getElementById('s2');
var bt=document.getElementById('bt1');
var in1=document.getElementById('in1');
var in2=document.getElementById('in2');
var fm=document.getElementById('form');
var warn=document.getElementById('warning');
var def=document.getElementById('default');





window.onload = function(){

  contr = new Contr();
  contr.bt.style.display="none";
  contr.in1.style.display="none";
  contr.in2.style.display="none";
  warn.style.display="none";

}

function hideIn() {
  contr.in1.style.display="none";
  contr.in2.style.display="none";

  contr.in2.value="";
  contr.in1.value="";

  contr.in1HD = true;
  contr.in2HD = true;
  if (contr.attrShow) {
    for (var i = 0; i < contr.attrIn.length; i++) {
      contr.attrIn[i].style.display = "none";
    }

  } else {

  }

  if (contr.rowCreShow) {
    for (var i = 0; i < num; i++) {
      if((typeof contr.rowCre[i])!= "undefined"){
        contr.rowCre[i].style.display = "none";
      }

    }
    contr.rowCreShow = false;
  }

  if (contr.rowDelShow) {
    for (var i = 0; i < num; i++) {
      if ((typeof contr.rowDel[i])!= "undefined") {
        contr.rowDel[i].style.display = "none";
      }
    }
    contr.rowDelShow = false;
  }

  if (contr.tabDelShow) {
    contr.tabDel.style.display="none";
    contr.tabDelShow=false;
  }

}


function f1() {
  contr.bt.style.display="none";
  hideIn();
  contr.btHD = true;
}

function f2() {

  contr.select=2;
  contr.bt.style.display = "none";

  if (contr.attrShow) {
    for (var i = 0; i < contr.attrIn.length; i++) {
      contr.attrIn[i].style.display = "none";
    }

  } else {

  }
  if (contr.rowCreShow) {
    for (var i = 0; i < contr.rowCre.length; i++) {
      contr.rowCre[i].style.display = "none";
    }
  }

  if (contr.rowDelShow) {
    for (var i = 0; i < num; i++) {
      contr.rowDel[i].style.display = "none";
    }
    contr.rowDelShow = false;
  }

  if (contr.tabDelShow) {
    contr.tabDel.style.display="none";
    contr.tabDelShow=false;
  }

  contr.cre = true;

  contr.in1HD=false;
  contr.in2HD=false;

  in1.style.display="inline";
  in2.style.display="inline";
}

function f3() {       //ADD ROW
  hideIn();
  if (contr.tableNumber>0) {
    contr.bt.style.display = "inline";
  }


  contr.select=3;
  contr.rowCreShow = true;
  for (var i = 0; i < num; i++) {

    var inp = document.createElement("input");
    inp.id = contr.tableArray[contr.nowTable].name+"attr"+contr.tableArray[contr.nowTable].row.length+i; //row input ID name = TableName+attr+rowNumber+i
    inp.placeholder=contr.tableArray[contr.nowTable].attr[i];
    contr.rowCre[i]=inp;
    contr.fm.appendChild(inp);

  }

}

function f4() {     //DELETE Row
  hideIn();
  if (contr.tableNumber>0) {
    contr.bt.style.display = "inline";
  }

  contr.select=4;
  contr.rowDelShow = true;

  for (var i = 0; i < num; i++) {

    var inp = document.createElement("input");
    // inp.id = contr.tableArray[contr.nowTable].name+"delete"+contr.tableArray[contr.nowTable].row.length+i; //row input ID name = TableName+delete+rowNumber+i
    inp.placeholder=contr.tableArray[contr.nowTable].attr[i];
    contr.rowDel[i]=inp;
    contr.fm.appendChild(inp);

  }

}

function f5() {
  hideIn();
  if (contr.tableNumber>0) {
    contr.bt.style.display = "inline";
  }

  contr.select=5;
  contr.tabDelShow = true;
  contr.tabDel = warn;
  warn.style.display = "block";
}

function change(value) {

  if (value==1) {
    f1();
  }else if (value==2) {
    f2();
  }else if (value==3&contr.cre) {
    f3();
  }else if (value==4&contr.cre) {
    f4();
  }else if (value==5&contr.cre){
    f5();
  }
}

select2.onchange = function chaT() {
  if (contr.nowTable>0) {
    contr.tableArray[contr.nowTable].table.style.display="none";
  }

  contr.nowTable = contr.select2.selectedIndex;

  if (contr.nowTable>0) {
    contr.tableArray[contr.nowTable].table.style.display="table";
    num = contr.tableArray[contr.nowTable].attr.length;
    contr.hasRow = contr.tableArray[contr.nowTable].row.length;
  }else {
    num = 0;
    hasRow=0;
  }

}

in1.onchange = function checkIn2() {
  if (in1.value=="") {
    contr.bt.style.display = "none";
  }
}

in2.onchange = function creT() {
  num = parseInt(contr.in2.value);                        //change num after change select2 !!!!

  if (num>0&contr.in1.value!="") {
    if (contr.attrShow) {
    for (var i = 0; i < contr.attrIn.length; i++) {
      contr.attrIn[i].style.display = "none";
    }

  } else {

  }
    contr.attrShow=true;
    contr.attrIn = new Array(num);
    contr.attrValCheck = new Array(num);
    contr.rowCre = new Array(num);
    contr.rowDel = new Array(num);

    for (var i = 0; i < num; i++) {

      var inp = document.createElement("input");
      inp.id = contr.in1.value+"inp"+i;                    //Attribute input ID name = TableName+inp+1
      inp.placeholder="Attribute";
      contr.attrIn[i]=inp;
      contr.attrIn[i].onchange = function butShow() {
        var cre = false;
        for (var i = 0; i < contr.attrIn.length; i++) {
          cre = cre||contr.attrIn[i].value=="";
        }
        if (!cre) {
          contr.bt.style.display = "inline";
        }else {
          contr.bt.style.display = "none";

        }
      }
      contr.fm.appendChild(inp);

    }
    //
    // contr.bt.style.display = "inline";
  }else {
    contr.in2.value = "";
  }
}

bt.onclick = function sub() {
  var cre = true;
  for (var i = 0; i < contr.attrIn.length; i++) {
    cre = cre&contr.attrIn[i].value=="";
  }

  var rowCrea = true;
  if (contr.rowCreShow) {
    for (var i = 0; i < num; i++) {
      if((typeof contr.rowCre[i])!= "undefined"){
        rowCrea = rowCrea&contr.rowCre[i].value=="";
      }
    }
  }

  if (contr.select==2&(!cre)) {
    contr.tableNumber = contr.tableNumber+1;
    var arr = new Array();
    for (var i = 0; i < num; i++) {
      arr[i] = contr.attrIn[i].value;
    }

    if (contr.nowTable>0) {
      contr.tableArray[contr.nowTable].table.style.display="none";
    }

    var nowTB = new Table(contr.in1.value,arr);
    nowTB.show = true;
    contr.nowTable = contr.tableArray.length;
    contr.tableArray[contr.tableArray.length] = nowTB;



    var op1 = document.createElement("option");
    op1.innerHTML= contr.in1.value ;
    op1.value = contr.tableArray.length;
    op1.id = "op"+op1.value;
    op1.selected = true;
    nowTB.option = op1;

    contr.select2.appendChild(op1);
    contr.select2.style.display = "inline";

    var tb = document.createElement("table");
    nowTB.table=tb;

    tb.cellSpacing="2em";
    // var th = document.createElement("th");


    for (var i = 0; i < num; i++) {
      var th = document.createElement("th");
      th.innerHTML= contr.attrIn[i].value;
      tb.appendChild(th);
    }

    contr.bt.parentNode.appendChild(tb);


  }else if (contr.select==3&(!rowCrea)) {    //ADD ROW

    var tr = document.createElement("tr");
    var contain = new Array(num);

    var nowTable = contr.tableArray[contr.nowTable];

    for (var i = 0; i < num; i++) {
      var td = document.createElement("td");
      td.innerHTML= contr.rowCre[i].value;
      contain[i] = contr.rowCre[i].value;
      tr.appendChild(td);
    }

    contr.hasRow += 1 ;
    nowTable.rowContain[nowTable.row.length] = contain;
    nowTable.row[nowTable.row.length] = tr;
    nowTable.table.appendChild(tr);

  }else if (contr.select==4) {    //DELETE ROW

    var nowTable = contr.tableArray[contr.nowTable];

    for (var i = 0; i < nowTable.row.length; i++) {
      var del = true;
      for (var j = 0; j < nowTable.rowContain[i].length; j++) {
        if((nowTable.rowContain[i][j]!=contr.rowDel[j].value)
        &(contr.rowDel[j].value != "")){
          del = false;
        }
      }
      if (del) {
        nowTable.row[i].style.display = "none";
      }
    }

  }else if (contr.select==5) {    //DELETE TABLE
    var change = false;
    if (contr.nowTable>0) {
      var nowTable = contr.tableArray[contr.nowTable];
      nowTable.table.style.display = "none";
      nowTable.option.style.display = "none";
      nowTable.del = true;
      contr.tableNumber = contr.tableNumber-1;
    }
    for (var i = contr.nowTable; i < contr.tableArray.length; i++) {
      if ((contr.tableArray[i].del==false)&(change==false)) {
        contr.nowTable = i;
        contr.tableArray[i].option.selected = true;
        contr.tableArray[contr.nowTable].table.style.display="table";
        num = contr.tableArray[contr.nowTable].attr.length;
        contr.hasRow = contr.tableArray[contr.nowTable].row.length;
        change = true;
      }
    }

    if (change==false) {
      def.selected=true;
      num = 0;
      contr.hasRow = 0;
    }
  }


}
