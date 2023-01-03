import cv2
import numpy as np
cap = cv2.VideoCapture(1)

while True:
    _,frame = cap.read()
    gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    blur = cv2.GaussianBlur(gray_frame,(5,5),0)

    canny = cv2.Canny(blur, 250, 150)
    cv2.imshow("CAMEO", canny)
    k = cv2.waitKey(1)
    if k==27:
        break
cap.release()
cv2.destroyAllWindows()
