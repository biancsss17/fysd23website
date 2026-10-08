const assert=require('node:assert/strict');
const {chromium}=require('C:/Users/User/.cache/codex-runtimes/codex-primary-runtime/dependencies/node/node_modules/playwright');
(async()=>{
 const browser=await chromium.launch({executablePath:'C:/Program Files/Google/Chrome/Application/chrome.exe',headless:true});
 const page=await browser.newPage({viewport:{width:1440,height:900}});const errors=[];page.on('pageerror',e=>errors.push(e.message));
 await page.addInitScript(()=>sessionStorage.setItem('uecfi-intro','1'));
 for(const path of ['/','/news']) {
  await page.goto('http://127.0.0.1:8005'+path,{waitUntil:'networkidle'});
  await page.mouse.move(120,250);await page.waitForTimeout(900);
  const left=await page.locator('.site-ribbons i').first().evaluate(el=>getComputedStyle(el).translate);
  await page.mouse.move(1300,650);await page.waitForTimeout(900);
  const right=await page.locator('.site-ribbons i').first().evaluate(el=>getComputedStyle(el).translate);
  assert.notEqual(left,right);assert(await page.locator('body').evaluate(el=>el.classList.contains('background-following')));
  assert.equal(await page.evaluate(()=>document.documentElement.scrollWidth>innerWidth),false);
  await page.screenshot({path:`storage/app/private/pointer-${path==='/'?'home':'news'}.png`});
  await page.evaluate(()=>document.documentElement.dispatchEvent(new PointerEvent('pointerleave')));await page.waitForTimeout(1800);
  assert(Math.abs(await page.evaluate(()=>parseFloat(document.body.style.getPropertyValue('--pointer-drift-x'))))<1);
  console.log(JSON.stringify({path,left,right,reset:true}));
 }
 await page.emulateMedia({reducedMotion:'reduce'});await page.mouse.move(300,300);await page.waitForTimeout(200);
 assert.equal(await page.locator('.site-ribbons i').first().evaluate(el=>getComputedStyle(el).translate),'none');
 assert.equal(await page.locator('.pointer-light').first().evaluate(el=>getComputedStyle(el).display),'none');
 assert.deepEqual(errors,[]);console.log('Reduced-motion fallback and browser errors: PASS');await browser.close();
})().catch(e=>{console.error(e);process.exit(1)});
