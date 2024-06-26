rm -rf release/feedback
mkdir -p release/feedback/api
#mkdir -p release/feedback/admin

cd frontend_user
npm run build
cd ..
#cd frontend_admin
#npm run build
#cd ..


cp -r frontend_user/dist/* release/feedback/
#cp -r frontend_admin/dist/* release/feedback/admin/
cp -r backend/* release/
rm release/feedback/api/repositories/*

cd release
zip -r all.zip feedback 
#ftp alireza@ohsconnect.com.au
