Για νέο repo:  
  
git clone https://github.com/hkoumaras/feedback-platform-admin.git  
git fetch origin -a  
git checkout develop  
  
  
  
Για να κάνω νέες αλλαγές:  
  
git checkout -b feature-dokimi  
  
git add .  
git commit -m "minima"  
  
git pull --rebase origin develop  
git checkout develop  
git pull --rebase origin develop 
git merge --no-ff feature-dokimi  
git push origin develop  
git branch -d feature-dokimi  
