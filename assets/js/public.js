var animateTexts =[
"Delivering Future Online Advertising solutions for Africa Today!",
"Native Recommendation(NR) let Advertisers promote a great story/article about their Product/Service to Prospects in a non-intrusive format while also providing african publisher a better Ad Format to increase their Ad Revenue.",
"Monetizing your Contents with the Ad format of the Future and Increase your Ad Revenue by 2X Today!"
];
setInterval(function(){
var max = animateTexts.length ;
var min = 0;
 var i = Math.floor(Math.random() * (max - min) ) + min;

 document.querySelector('div[id="displayText"]').innerHTML=animateTexts[i];
i++;
},1000);



function createPublisherScreen(){
return `<div class="">
 

</div>
`;
}


function createAdvertiserScreen(){
    return `<div class="">
     <
    
    </div>
    `;
    }





