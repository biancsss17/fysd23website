const assert=require('node:assert/strict');
const {chromium}=require('C:/Users/User/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
(async()=>{const browser=await chromium.launch({executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe',headless:true});
for(const width of [1440,390]){
 const page=await browser.newPage({viewport:{width,height:900},reducedMotion:'reduce'});const errors=[];page.on('pageerror',e=>errors.push(e.message));
 await page.goto('http://127.0.0.1:8005/',{waitUntil:'networkidle'});
 const button=page.getByRole('button',{name:'Dark mode',exact:true});await button.click();
 assert.equal(await button.getAttribute('aria-pressed'),'true');assert.equal(await page.evaluate(()=>localStorage.getItem('uecfi-theme')),'dark');
 await page.screenshot({path:`storage/app/private/theme-dark-${width}.png`});
 await page.reload({waitUntil:'networkidle'});assert.equal(await page.locator('html').getAttribute('data-theme'),'dark');
 await page.goto('http://127.0.0.1:8005/news',{waitUntil:'networkidle'});assert.equal(await page.locator('html').getAttribute('data-theme'),'dark');
 assert.equal(await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth),false);
 await page.getByRole('button',{name:'Dark mode',exact:true}).focus();await page.keyboard.press('Enter');assert.equal(await page.locator('html').getAttribute('data-theme'),'light');
 assert.deepEqual(errors,[]);console.log(JSON.stringify({width,toggle:true,persistsOnReloadAndNavigation:true,keyboard:true,errors}));await page.close();
}await browser.close()})().catch(e=>{console.error(e);process.exit(1)});
