const {chromium}=require('C:/Users/User/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
(async()=>{
const browser=await chromium.launch({executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe',headless:true});
for(const width of [1440,1024,390]){
 const page=await browser.newPage({viewport:{width,height:900}}); const errors=[];page.on('pageerror',e=>errors.push(e.message));
 await page.addInitScript(()=>sessionStorage.setItem('uecfi-intro','1'));
 await page.goto('http://127.0.0.1:8005/',{waitUntil:'networkidle'});await page.waitForTimeout(2200);
 await page.screenshot({path:`storage/app/private/hero-ribbons-${width}.png`});
 const layout=await page.evaluate(()=>({overflow:document.documentElement.scrollWidth>innerWidth,lines:[...document.querySelectorAll('.headline-line')].map(el=>({fits:el.scrollWidth<=el.clientWidth+1})),animation:getComputedStyle(document.querySelector('.hero-ribbons i')).animationName}));
 console.log(JSON.stringify({width,...layout,errors}));if(layout.overflow||layout.lines.some(l=>!l.fits)||errors.length)process.exitCode=1;
 await page.close();
}await browser.close();
})().catch(e=>{console.error(e);process.exit(1)});
