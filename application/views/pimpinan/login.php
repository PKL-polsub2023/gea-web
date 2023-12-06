<html>
<head>
<title>SIMML</title>
</head>
<style>

@import url("https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;500&display=swap");

:root {
  --primary: #e5e8ef;
  --primary-dark: #e1e4ea;
  --secondary-lime: #e1ff2d;
  --secondary-lavender: #d3b7f8;
  --primary-box-shadow: -7px -7px 20px 0px #fff9, -4px -4px 5px 0px #fff9,
    7px 7px 20px 0px #0002, 4px 4px 5px 0px #0001, inset 0px 0px 0px 0px #fff9,
    inset 0px 0px 0px 0px #0001, inset 0px 0px 0px 0px #fff9,
    inset 0px 0px 0px 0px #0001;
  --secondary-box-shadow: 4px 4px 6px 0 rgba(255, 255, 255, 0.5),
    -4px -4px 6px 0 rgba(116, 125, 136, 0.2),
    inset -4px -4px 6px 0 rgba(255, 255, 255, 0.5),
    inset 4px 4px 6px 0 rgba(116, 125, 136, 0.3);
  --font: "Nunito Sans", sans-serif;
}

body {
  background: var(--primary);
  display: grid;
  height: 100vh;
  place-items: center;
  font-family: "Nunito Sans", sans-serif;
}
form {
  display: flex;
  flex-direction: column;
  padding-block: 24px;
  border-radius: 20px;
  background: linear-gradient(145deg, #f1f4fa, #cbcdd3);
  box-shadow: var(--primary-box-shadow);
  height: 360px;
  width: 300px;
  justify-content: space-between;
  align-items: center;
}

input, select {
  border: none;
  height: 32px;
  border-radius: 10px;
  background: linear-gradient(145deg, #f1f4fa, #cbcdd3);
  outline: none;
  font-family: "Nunito Sans", sans-serif;
}

input[type="text"],
input[type="password"],
select {
  box-shadow: var(--secondary-box-shadow);
  padding-inline: 20px;
  height: 49px;
  width: 60%;
}

input[type="submit"] {
  box-shadow: var(--primary-box-shadow);
  cursor: pointer;
  font-weight: 800;
  letter-spacing: 0.8px;
  height: 50px;
  font-size: 1rem;
  color: #5a5a5a;
  position: relative;
  z-index: 100;
  width: 100%;
}
#title {
  color: #5a5a5a;
  font-weight: 800;
  font-size: 1.1rem;
  line-height: 1;
  letter-spacing: 0.8px;
}
#linksParent {
  display: flex;
  gap: 8px;
  flex-direction: column;
  align-items: center;
}
#linksParent > a {
  font-family: "Nunito Sans", sans-serif;
  font-size: 0.8rem;
  color: gray;
  text-decoration: underline;
  cursor: pointer;
}

.rip1,
.rip2 {
  filter: blur(1px);
  width: 100%;
  position: absolute;
  height: 50px;
  left: 0;
  bottom: 0;
}
.rip1 {
  box-shadow: 0.4rem 0.4rem 0.8rem #c8d0e7, -0.4rem -0.4rem 0.8rem #fff;
  background: linear-gradient(to bottom right, #fff 0%, #c8d0e7 100%);
  animation: waves 2s linear infinite;
}
.rip2 {
  box-shadow: 0.4rem 0.4rem 0.8rem #c8d0e7, -0.4rem -0.4rem 0.8rem #fff;
  animation: waves 2s linear 1s infinite;
}

@keyframes waves {
  0% {
    transform: scale(0.7);
    opacity: 1;
    border-radius: 10px;
  }

  50% {
    opacity: 1;
    border-radius: 15px;
  }

  100% {
    transform: scale(2);
    opacity: 0;
    border-radius: 20px;
  }
}
#button {
  width: 40%;
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
}


</style>





<form action="<?php echo base_url('login/aksi_login'); ?>" method="post">	
  <span id="title">Silahkan Masuk</span>
  <input type="text" id="username" name="username" placeholder="Username">
  <input type="password" id="password" name="password" placeholder="Password">
  <select name="role" id="role">
    <option value="akuntan">Akuntan</option>
    <option value="admin">Admin</option>
  </select>
  <div id="button">
    <input type="submit" value="Login">
    <span class="rip1"></span>
    <span class="rip2"></span>
  </div>
  <div id="linksParent">
    <a>Daftar</a>
    <a>Lupa Password ?</a>
  </div>
</form>

<!-- https://Github.com/YasinDehfuli
	 https://Codepen.io/YasinDehfuli
	 -->
