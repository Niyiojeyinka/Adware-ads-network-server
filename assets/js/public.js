var state={previousX:1};
var animateTexts =[
"Delivering Future Online Advertising solutions for Africa Today!",
"Native Recommendation(NR) let Advertisers promote a great story/article about their Product/Service to Prospects in a non-intrusive format while also providing african publisher a better Ad Format to increase their Ad Revenue.",
"Monetizing your Contents with the Ad format of the Future and Increase your Ad Revenue by 2X Today!",
"Low minimum payout for Publishers"
];




var features =[
    [
        { 
          "icon":"user",
          "iconColor":"pink",
          "topic":"Interest Targeting",
          "paragragh":"With Interest Targeting,Your campaign is shown only to Audience who are likely to React to your Campaign.",
          "animateDirection":"right"
        },
        { 
            "icon":"map",
            "iconColor":"yellow",
            "topic":"Country Targeting",
            "paragragh":"Our Targeting facilities includes Country targeting which let you choose audience who can see your campaign by country.",
            "animateDirection":"left"
          },
          { 
            "icon":"laptop",
            "iconColor":"teal",
            "topic":"Device Targeting",
            "paragragh":"This let you target your audience by type of device they are using to surf the internet.option includes mobile ,desktop",
            "animateDirection":"left"
          },
          { 
            "icon":"android",
            "iconColor":"green",
            "topic":"Platform Targeting",
            "paragragh":"This let you target your audience by type of platform or OS their device is made of.option includes android ,ios,windows etc.",
            "animateDirection":"right"
          },
        
        ]
        
,
[
    { 
      "icon":"font",
      "iconColor":"blue",
      "topic":"Keyword Targeting",
      "paragragh":"This let you target your audience by presence of certain keywords on the site or blog they using.",
      "animateDirection":"right"
    },
    { 
        "icon":"chrome",
        "iconColor":"yellow",
        "topic":"Browser Targeting",
        "paragragh":"Our Targeting facilities includes Country targeting which let you choose audience who can see your campaign by country.",
        "animateDirection":"left"
      },
      { 
        "icon":"edit",
        "iconColor":"red",
        "topic":"Recommendation Format",
        "paragragh":"Don't just sell your prospects,tell them a story instead.Telling them a story let you connect directly with their Emotion thereby increasing your leads by 2X.",
        "animateDirection":"left"
      },
      { 
        "icon":"image",
        "iconColor":"green",
        "topic":"Image & Text Format",
        "paragragh":"Apart from the recommendationm Ad format,we also offer high quality image and text advertisement format ",
        "animateDirection":"right"
      },
    
    ]
];

function getRandom(min,max) {
 return Math.floor(Math.random() * (max - min) ) + min;
}

setInterval(function(){
    let i =getRandom(0,animateTexts.length);

 document.querySelector('div[id="displayText"]').innerHTML=animateTexts[i];
i++;
},1000);



function createFeatureBox(icon ,iconColor,topic,paragraph,animateDirection,index){
    return `
    <style>
    .feature${index}:hover {
        margin-top:-0.5px !important;
    }
    </style>
    <div class="w3-padding w3-col s5 m5 l5 w3-padding w3-round-xxlarge w3-white w3-margin w3-animate-${animateDirection} feature${index}">
    <div class="w3-row">
      <div class="w3-col s3 l3 m3">
<i class="w3-xxlarge fa fa-${icon} w3-text-${iconColor}"></i>
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

function getFeaturHTML(x) {
  
let featuresHTML ='';
for (let i = 0; i < features[x].length; i++) {
    featuresHTML +=createFeatureBox(features[x][i]['icon'],features[x][i]['iconColor'],features[x][i]['topic'],features[x][i]['paragragh'],features[x][i]['animateDirection'],i) ;
}  
return featuresHTML;
}
    

function displayFeature() {
    let  x = getRandom(0,2);  

    document.querySelector('div[id="featurebox"]').innerHTML=getFeaturHTML(x);

}
setTimeout(function(){
   displayFeature();
    },1000);

    setInterval(function(){
        displayFeature();

        },5000);
        