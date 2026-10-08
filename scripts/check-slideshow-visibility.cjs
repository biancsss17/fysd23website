const assert=require('node:assert/strict');
const {chromium}=require('C:/Users/User/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
(async()=>{const browser=await chromium.launch({executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe',headless:true});
for(const theme of ['light','dark']){
 const page=await browser.newPage({viewport:{width:1440,height:900}});const errors=[];page.on('pageerror',e=>errors.push(e.message));
 await page.addInitScript(value=>{localStorage.setItem('uecfi-theme',value);sessionStorage.setItem('uecfi-intro','1')},theme);
 await page.goto('http://127.0.0.1:8005/',{waitUntil:'networkidle'});await page.waitForTimeout(1200);
 const initial=await page.locator('.hero-background.is-active').getAttribute('src');
 await page.waitForFunction(()=>getComputedStyle(document.querySelector('.hero-background.is-active')).opacity==='1');
 assert.equal(await page.locator('.hero-backdrops').evaluate(el=>getComputedStyle(el).opacity),'1');
 await page.screenshot({path:`storage/app/private/slideshow-visible-${theme}.png`});
 await page.waitForFunction(src=>document.querySelector('.hero-background.is-active').getAttribute('src')!==src,initial,{timeout:12000});
 await page.waitForTimeout(1000);
 assert.equal(await page.locator('.hero-background.is-active').evaluate(el=>getComputedStyle(el).opacity),'1');
 assert(await page.locator('img.hero-background.is-active').evaluate(el=>el.complete&&el.naturalWidth>0));
 assert.deepEqual(errors,[]);console.log(`${theme}: photos loaded, full opacity, automatic rotation, no JS errors`);await page.close();
}await browser.close()})().catch(e=>{console.error(e);process.exit(1)});
