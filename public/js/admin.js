(() => {
'use strict';
const menu=document.querySelector('.admin-menu');
menu?.addEventListener('click',()=>{const open=menu.getAttribute('aria-expanded')!=='true';menu.setAttribute('aria-expanded',String(open));document.querySelector('#admin-navigation').classList.toggle('open',open);});
const modal=document.querySelector('#delete-confirm');let pendingForm=null;
document.querySelectorAll('[data-delete]').forEach(form=>form.addEventListener('submit',e=>{e.preventDefault();pendingForm=form;modal.showModal();modal.querySelector('[data-cancel]').focus();}));
modal?.querySelector('[data-cancel]').addEventListener('click',()=>modal.close());
modal?.querySelector('[data-confirm]').addEventListener('click',()=>{if(pendingForm){modal.close();pendingForm.submit();}});
document.querySelectorAll('form:not([data-delete])').forEach(form=>form.addEventListener('submit',()=>{const button=form.querySelector('[data-save]');if(button){button.disabled=true;button.textContent='Saving…';}}));
document.querySelectorAll('[data-copy]').forEach(button=>button.addEventListener('click',async()=>{try{await navigator.clipboard.writeText(button.dataset.copy);button.textContent='Copied ✓';}catch{button.textContent='Select the URL from image preview';}}));
document.querySelectorAll('[data-remove-media]').forEach(button=>button.addEventListener('click',async()=>{
 const kind=button.dataset.mediaKind||'media';
 if(!window.confirm(`Permanently delete this ${kind}? It will be removed everywhere on the website.`))return;
 button.disabled=true;
 try{
  const response=await fetch(button.dataset.removeMedia,{method:'DELETE',credentials:'same-origin',headers:{'X-CSRF-TOKEN':button.dataset.csrf,'X-Requested-With':'XMLHttpRequest','Accept':'application/json'}});
  if(response.redirected&&new URL(response.url).pathname==='/admin/login')throw new Error('Your admin session expired. Log in again, then retry.');
  if(!response.ok)throw new Error(`Delete failed (HTTP ${response.status}). Refresh the admin page and retry.`);
  location.reload();
 }catch(error){button.disabled=false;window.alert(error.message||`Could not delete this ${kind}. Please refresh and try again.`);}
}));
document.querySelectorAll('[data-image-select]').forEach(select=>{
 const update=()=>{const url=select.selectedOptions[0]?.dataset.url,img=select.parentElement.querySelector('.selected-image');img.hidden=!url;if(url)img.src=url;};
 select.addEventListener('change',update);update();
});
const title=document.querySelector('input[name=title]'),slug=document.querySelector('input[name=slug]');
if(title&&slug){let auto=!slug.value;slug.addEventListener('input',()=>auto=false);title.addEventListener('input',()=>{if(auto)slug.value=title.value.toLowerCase().normalize('NFKD').replace(/[\u0300-\u036f]/g,'').replace(/[^a-z0-9]+/g,'-').replace(/^-|-$/g,'');});}
const preview=document.querySelector('#site-preview');
const previewStage=document.querySelector('.desktop-preview-stage');
const sizeDesktopPreview=()=>{if(!previewStage)return;const scale=Math.min(1,previewStage.clientWidth/1440);previewStage.style.setProperty('--desktop-preview-scale',scale);previewStage.style.height=`${850*scale}px`;};
if(previewStage){sizeDesktopPreview();new ResizeObserver(sizeDesktopPreview).observe(previewStage);}
document.querySelector('#refresh-preview')?.addEventListener('click',()=>preview.contentWindow.location.reload());
document.querySelector('#settings-form')?.addEventListener('input',e=>{
 const doc=preview?.contentDocument;if(!doc)return;
 const targets={hero_kicker:'.hero-copy .eyebrow',hero_description:'.hero-description',primary_text:'.hero .gold',secondary_text:'.hero .outline'};
 const target=targets[e.target.name];if(target&&doc.querySelector(target))doc.querySelector(target).textContent=e.target.value;
 if(e.target.name==='hero_heading'){const h=doc.querySelector('.hero h1');if(h){h.replaceChildren(...e.target.value.split('\n').map(line=>{const span=doc.createElement('span');span.className='headline-line';span.textContent=line;return span;}));}}
 const colors={primary_color:'--navy',secondary_color:'--gold',accent_color:'--purple'};
 if(colors[e.target.name])doc.documentElement.style.setProperty(colors[e.target.name],e.target.value);
});
})();
