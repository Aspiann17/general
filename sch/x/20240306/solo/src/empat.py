from util import intput, boolput

def main():
    domisili:bool = boolput("Apakah kamu tinggal di dalam negeri? (y/n): ",["y","yes"])
    ktp:bool = boolput("Apakah sudah memiliki KTP? (y/n): ",["y","yes"])
    usia:int = intput("Masukkan Usia")

    # if not (domisili and ktp and (usia >= 17))