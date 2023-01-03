import cv2
import os

cam = cv2.VideoCapture(0)
cam.set(3, 640) # set video width
cam.set(4, 480) # set video height

#pastikan 'haarcascade_frontalface_default.xml' ada di folder yang sama dengan kode ini
face_detector = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')

# Untuk setiap orang, masukkan satu id wajah numerik (harus memasukkan angka mulai dari 1, ini adalah label orang 1)
face_id = input('\n enter user id end press <return> ==>  ')

print("\n [INFO] Initializing face capture. Look the camera and wait ...")
# Inisialisasi hitungan wajah pengambilan sampel individu
count = 0

#mulai deteksi wajah Anda dan ambil 30 gambar
while(True):

    ret, img = cam.read()
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)
    faces = face_detector.detectMultiScale(gray, 1.3, 5)

    for (x,y,w,h) in faces:

        cv2.rectangle(img, (x,y), (x+w,y+h), (255,0,0), 2)     
        count += 1

        # Simpan gambar yang diambil ke dalam folder dataset
        cv2.imwrite("dataset/User." + str(face_id) + '.' + str(count) + ".jpg", gray[y:y+h,x:x+w])

        cv2.imshow('image', img)

    k = cv2.waitKey(100) & 0xff # Press 'ESC' for exiting video
    if k == 27:
        break
    elif count >= 30: # Take 30 face sample and stop video
         break

# Do a bit of cleanup
print("\n [INFO] Exiting Program and cleanup stuff")
cam.release()
cv2.destroyAllWindows()


