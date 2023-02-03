function test1(form){
    let number1 = form.Nombre1.value;
    let number2 = form.Nombre2.value;
    let sum = Number(number1)+Number(number2);
document.getElementById("response").innerHTML = sum;
document.getElementById("nombre1").innerHTML = number1;
document.getElementById("nombre2").innerHTML = number2;
console.log(sum)
}


console.clear();
const svg = document.querySelector("svg");

const svgns = "http://www.w3.org/2000/svg";

// change any value
let width = 120;
let height = 100;
let columns = 4;
let rows = 5;
let counter = 0;
const colorArray = ["#94c356", "#46a4cc", "#a63e4b"];

// figure the new svg width/height
const svgWidth = width * columns;
const svgHeight = height * rows;

gsap.set(svg, {
  attr: {
    width: svgWidth,
    height: svgHeight,
    viewBox: "0 0 " + svgWidth + " " + svgHeight
  }
});
for (let j = 0; j < rows; j++) {
  for (let i = 0; i < columns; i++) {
    counter++;
    let newRect = document.createElementNS(svgns, "rect");
    gsap.set(newRect, {
      attr: {
        x: i * width,
        y: j * height,
        width: width,
        height: height,
        fill: colorArray[counter % colorArray.length]
      }
    });
    svg.appendChild(newRect);
  }
}