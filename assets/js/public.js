var animateTexts =[
"Delivering Future Online Advertising solutions for Africa Today!",
"Native Recommendation(NR) let Advertisers promote a great story/article about their Product/Service to Prospects in a non-intrusive format while also providing african publisher a better Ad Format to increase their Ad Revenue.",
"Monetizing your Contents with the Ad format of the Future and Increase your Ad Revenue by 2X Today!"
];


var features =[
{ },
{ },
{ }
]
setInterval(function(){
var max = animateTexts.length ;
var min = 0;
 var i = Math.floor(Math.random() * (max - min) ) + min;
 document.querySelector('div[id="displayText"]').innerHTML=animateTexts[i];
i++;
},1000);



function createFeatureBox(icon ,iconColor,topic,paragraph,animateDirection){
    return `
    <div class="w3-padding w3-col s5 m5 l5 w3-padding w3-round-xxlarge w3-white w3-margin w3-animate-${animateDirection}">
    <div class="w3-row">
      <div class="w3-col s3 l3 m3">
<i class="w3-jumbo fa fa-${icon} w3-text-${iconColor}"></i>
      </div>
<div class="w3-padding w3-col s9 l9 m9">
        <span class="w3-medium w3-hover-text-blue">${topic}</span>
        <p class="w3-text-gray w3-tiny">
        ${paragraph}
        </p>
      </div>
    </div>
  </div>
    `;
    }





