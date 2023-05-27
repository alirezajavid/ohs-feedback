rm -rf release/rules
mkdir -p release/rules/api
#mkdir -p release/rules/admin

cd frontend_user
npm run build
cd ..
#cd frontend_admin
#npm run build
#cd ..


cp -r frontend_user/dist/* release/rules/
#cp -r frontend_admin/dist/* release/rules/admin/
cp -r backend/* release/rules/
rm release/rules/api/repositories/*

cd release
zip -r all.zip rules 
#ftp alireza@ohsconnect.com.au
