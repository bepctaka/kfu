**FFKR project based on Symfony 3.4**

Installation
========================

1. Clone or download repository

    https://bitbucket.org/irokezprogrammers/ffkr-back.git


2. Go to your project dir

    cd ffkr-back

3. Run composer install

    composer intall
    
4. Add folder uploads in web folder

   chown -R www-data web/uploads 

5. Added permissions

```
 HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

 sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
 sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
```