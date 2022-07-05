const darkBtn = document.querySelector('#toggleTheme');
const btn = document.querySelector('.btn');
darkBtn.addEventListener('click',()=>{
    darkBtn.checked?document.body.classList.add('dark'):document.body.classList.remove("dark");
    darkBtn.checked?btn.classList.add('active'):btn.classList.remove('active');
    localStorage.setItem('darkModeStatus', darkBtn.checked)
});
window.addEventListener('load',(event)=>{
    if(localStorage.getItem('darkModeStatus')=='true'){
        document.body.classList.add('dark')
        document.querySelector('.btn').classList.add('active');
        document.getElementById('toggleTheme').checked = true
    }
})

const comBtn = document.querySelectorAll('.edit-del-btn');

comBtn.forEach(cmb=>{
    const cmBtn = cmb.querySelector('.edit-delete');
    const com = cmb.querySelector('.com-btn');
        cmBtn.addEventListener('click',()=>{
            com.classList.toggle('com-show');
        })
})

const search = document.querySelector('.search-button img');
const searchBox = document.querySelector('.search-form');
const searchCross = document.querySelector('.search-cross img');

search.addEventListener('click', ()=>{
    searchBox.classList.add('show-search');
    searchCross.classList.remove('hide-cross');
})

searchCross.addEventListener('click',()=>{
    searchBox.classList.remove('show-search');
    searchCross.classList.add('hide-cross');
})

const editCross = document.querySelector('.edit-close');
const edit = document.querySelector('.edit');
editCross.addEventListener('click',()=>{
    edit.classList.remove('show-add');
    editCross.classList.remove('edit-crossShow');
})