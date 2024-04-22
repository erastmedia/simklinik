<?php

namespace App\Http\Controllers;
use App\Models\Pabrik;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DataTables;

class PabrikController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $idklinik = auth()->user()->id_klinik;
        return view('master.pabrik.index', compact('idklinik'));
    }

    public function copyPreset()
    {
        $id_klinik = auth()->user()->id_klinik;
        $current_time = now();
        $pabriks = [
            ['id_klinik' => $id_klinik, 'nama' => '3M INDONESIA IMPORTAMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ABBOT INDONESIA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'ABBOTT INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ACTAVIS'],
            ['id_klinik' => $id_klinik, 'nama' => 'ACTAVIS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'AIR MANCUR'],
            ['id_klinik' => $id_klinik, 'nama' => 'AKSAMALA'],
            ['id_klinik' => $id_klinik, 'nama' => 'AL-GHUROBA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ALWALIY SEJAHTERA'],
            ['id_klinik' => $id_klinik, 'nama' => 'AMAROX PHARMA GLOBAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'ANCHOR'],
            ['id_klinik' => $id_klinik, 'nama' => 'ANEKA BOGA CITRA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ANUGERAH PHARMINDO LESTARI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ARBA\'IN JAYA MANDIRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ARKSTARINDO ARTHA MAKMUR'],
            ['id_klinik' => $id_klinik, 'nama' => 'ASTRAZENECA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'AVENTIS PHARMA PT.'],
            ['id_klinik' => $id_klinik, 'nama' => 'B. BRAUN PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'BAHAGIA IDHO M'],
            ['id_klinik' => $id_klinik, 'nama' => 'BALATIF'],
            ['id_klinik' => $id_klinik, 'nama' => 'BARCLAY PRODUCT'],
            ['id_klinik' => $id_klinik, 'nama' => 'BAYER'],
            ['id_klinik' => $id_klinik, 'nama' => 'BAYER INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'BAYER INDONESIA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'BAYER PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'BBRAUN'],
            ['id_klinik' => $id_klinik, 'nama' => 'BEIERSDORF'],
            ['id_klinik' => $id_klinik, 'nama' => 'BEIRESDORF INDONESIA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'BERNOFARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'BETA PHARMACON'],
            ['id_klinik' => $id_klinik, 'nama' => 'BINA KARYA PRIMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'BINDAWOOD'],
            ['id_klinik' => $id_klinik, 'nama' => 'BINTANG KUPU-KUPU'],
            ['id_klinik' => $id_klinik, 'nama' => 'BINTANG TOEDJOE'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOEHRINGER'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOEHRINGER INGELHEIM'],
            ['id_klinik' => $id_klinik, 'nama' => 'BOEHRINGER INGELHEIM INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'BROMO'],
            ['id_klinik' => $id_klinik, 'nama' => 'BUFA ANEKA'],
            ['id_klinik' => $id_klinik, 'nama' => 'Caprifarmindo'],
            ['id_klinik' => $id_klinik, 'nama' => 'CAPRIFARMINDO LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'CARUS PHARMA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'CENDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'CITO'],
            ['id_klinik' => $id_klinik, 'nama' => 'CIUBROS FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'COMBIPHAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'COMBIPHAR, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'CORONET CROW'],
            ['id_klinik' => $id_klinik, 'nama' => 'CORONET CROWN'],
            ['id_klinik' => $id_klinik, 'nama' => 'Corsa'],
            ['id_klinik' => $id_klinik, 'nama' => 'CORSA INDUSTRIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'CUSSONS'],
            ['id_klinik' => $id_klinik, 'nama' => 'CUSSONS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'CV. PUTRA JAYA ABADI PUTRA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DANKOS FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DANPAC PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DARYA VARIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DARYA VARIA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'DARYA-VARIA LABORATORIA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'DELTO MED'],
            ['id_klinik' => $id_klinik, 'nama' => 'DELTOMED'],
            ['id_klinik' => $id_klinik, 'nama' => 'DEXA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DEXA MEDICA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DEXA MEDICA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'Dexa Medika'],
            ['id_klinik' => $id_klinik, 'nama' => 'DIA PHARMACEUTICAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'DIPA PHARMALAB INTERSAINS'],
            ['id_klinik' => $id_klinik, 'nama' => 'DJEMBATAN DUA'],
            ['id_klinik' => $id_klinik, 'nama' => 'DODORINDO JAYA ABADI'],
            ['id_klinik' => $id_klinik, 'nama' => 'EISAI INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'EISAI INDONESIA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'ELANAZMA PRIMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ENSEVAL PUTERA MEGATRADING TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'ERA VARIASI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ERELA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ERELA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'ERLIMPEX'],
            ['id_klinik' => $id_klinik, 'nama' => 'ESSITY'],
            ['id_klinik' => $id_klinik, 'nama' => 'ETERCON PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'FABINDO SEJAHTERA'],
            ['id_klinik' => $id_klinik, 'nama' => 'FAHRENHEIT'],
            ['id_klinik' => $id_klinik, 'nama' => 'FAIRPACK'],
            ['id_klinik' => $id_klinik, 'nama' => 'FERRON PAR PHARMACETICALS PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'FERRON PAR PHARMACEUTICALS'],
            ['id_klinik' => $id_klinik, 'nama' => 'FINUSOLPRIMA FARMA INTERNASIONAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'FIRST MEDIPHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'FITTO NATURA MEDICA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'FONTERNA BMI'],
            ['id_klinik' => $id_klinik, 'nama' => 'FRESENIUS KABI COMBIPHAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'FRISIAN FLAG'],
            ['id_klinik' => $id_klinik, 'nama' => 'GALDERMA INDONESIA HEALTHCARE, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'GALENIUM'],
            ['id_klinik' => $id_klinik, 'nama' => 'GALENIUM PHARMASIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GALENIUM PHARMASIA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'GELENIUM PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'Generic Manufacturer'],
            ['id_klinik' => $id_klinik, 'nama' => 'GENERIK'],
            ['id_klinik' => $id_klinik, 'nama' => 'GENERO PHARMACEUTICAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'GENERO PHARMACEUTICALS'],
            ['id_klinik' => $id_klinik, 'nama' => 'GLAXO'],
            ['id_klinik' => $id_klinik, 'nama' => 'Glaxo Smith Kline'],
            ['id_klinik' => $id_klinik, 'nama' => 'GLAXO SMITH KLINE PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'GLAXO WELLCOME INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GLORIA ORIGITA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRACIA PHARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRAHA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRAHA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRATIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRATIA HUSADA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRATIA HUSADA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GREENSAFA'],
            ['id_klinik' => $id_klinik, 'nama' => 'GRIYA AN NUR'],
            ['id_klinik' => $id_klinik, 'nama' => 'GSF'],
            ['id_klinik' => $id_klinik, 'nama' => 'GUARDIAN PHARMATAMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'HANSAPLAST'],
            ['id_klinik' => $id_klinik, 'nama' => 'HARSEN'],
            ['id_klinik' => $id_klinik, 'nama' => 'HEIFEI KOBAYASI'],
            ['id_klinik' => $id_klinik, 'nama' => 'HERLINAINDAH'],
            ['id_klinik' => $id_klinik, 'nama' => 'HEXPHARM JAYA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'HOLI PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'IBROHIM HERBAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'IBU SRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'IFARS'],
            ['id_klinik' => $id_klinik, 'nama' => 'IFARS PHARMACEUTICAL LAB PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'IFARS PHARMACEUTICAL LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'Ikapharmindo'],
            ['id_klinik' => $id_klinik, 'nama' => 'IKAPHARMINDO PUTRAMAS'],
            ['id_klinik' => $id_klinik, 'nama' => 'IMEDCO DJAJA'],
            ['id_klinik' => $id_klinik, 'nama' => 'IMMORTAL PHARMACEUTICAL LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'IMPLORA SUKSES'],
            ['id_klinik' => $id_klinik, 'nama' => 'INDOFARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'INTEGRATED HEALTHCARE'],
            ['id_klinik' => $id_klinik, 'nama' => 'INTEGRATED HEALTHCARE INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'INTERBAT'],
            ['id_klinik' => $id_klinik, 'nama' => 'INTISUMBER HASIL SEMPURNA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'INTISUMBER HASILSEMPURNA'],
            ['id_klinik' => $id_klinik, 'nama' => 'Invida'],
            ['id_klinik' => $id_klinik, 'nama' => 'IPI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ITRASAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'JASMINE FOOD'],
            ['id_klinik' => $id_klinik, 'nama' => 'JAYA INDAH PRATAMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'JAYAMAS MEDICA INDUSTRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'JHONSON'],
            ['id_klinik' => $id_klinik, 'nama' => 'JMI'],
            ['id_klinik' => $id_klinik, 'nama' => 'JOENEOS'],
            ['id_klinik' => $id_klinik, 'nama' => 'JOHNSON'],
            ['id_klinik' => $id_klinik, 'nama' => 'KALBE'],
            ['id_klinik' => $id_klinik, 'nama' => 'KALBE FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'KALBE FARMA - Indonesia'],
            ['id_klinik' => $id_klinik, 'nama' => 'KIMIA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'KIMIA FARMA Tbk.'],
            ['id_klinik' => $id_klinik, 'nama' => 'KIMIA FARMA, Jakarta'],
            ['id_klinik' => $id_klinik, 'nama' => 'KINO'],
            ['id_klinik' => $id_klinik, 'nama' => 'KINO INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'KODOMO POWDER REFRESING GR 51'],
            ['id_klinik' => $id_klinik, 'nama' => 'KONIMEX'],
            ['id_klinik' => $id_klinik, 'nama' => 'Lapas'],
            ['id_klinik' => $id_klinik, 'nama' => 'LAPI'],
            ['id_klinik' => $id_klinik, 'nama' => 'LAPI LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'LAPI LABORATORIES PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'LION WINGS'],
            ['id_klinik' => $id_klinik, 'nama' => 'LKPI'],
            ['id_klinik' => $id_klinik, 'nama' => 'LLOYD PHARMA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'LUCAS DJAJA'],
            ['id_klinik' => $id_klinik, 'nama' => 'L`OREAL INDONESIA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'MAHAKAM BETA F'],
            ['id_klinik' => $id_klinik, 'nama' => 'MAHAKAM BETA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MAHAKAM BETAFARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MANDOM INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MARGUNA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MARTHA TILAAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'MBF'],
            ['id_klinik' => $id_klinik, 'nama' => 'MECCAYA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MECOSIN'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEDICIN PRIMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'Medifarma'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEDIFARMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEDIKON'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEDIKON PRIMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEGA PRATAMA MEDICALINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEIJI'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEIJI INDONESIAN PHARMACEUTICAL INDUSTRIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEIJI PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'MENARINI INDRIA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEPRO'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEPROFARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'MEPROFARM PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'MERCK'],
            ['id_klinik' => $id_klinik, 'nama' => 'MERCK SHARP & DOHME PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MERCK TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'MERSI'],
            ['id_klinik' => $id_klinik, 'nama' => 'Mersi Farma'],
            ['id_klinik' => $id_klinik, 'nama' => 'MERSIFARMA TIRMAKU MERCUSANA'],
            ['id_klinik' => $id_klinik, 'nama' => 'METISKA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MINOROCK MANDIRI PT.'],
            ['id_klinik' => $id_klinik, 'nama' => 'MITRA IHSAN SEJAHTERA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MITSUBISHI TANABE PHARMA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MOLEX AYUS'],
            ['id_klinik' => $id_klinik, 'nama' => 'MOLEX AYUS PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'MULIA FARMA SUCI'],
            ['id_klinik' => $id_klinik, 'nama' => 'MUNDIPHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'MUNDIPHARMA LABORATORIES PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'MUSTIKA RATU'],
            ['id_klinik' => $id_klinik, 'nama' => 'MUTIARA MUKTI FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NATURA PESONA MANDIRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'NELCO'],
            ['id_klinik' => $id_klinik, 'nama' => 'NELCO INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NELLCO INDOPHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NELLCO INDOPHARMA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'NESTLE'],
            ['id_klinik' => $id_klinik, 'nama' => 'NICHOLAS'],
            ['id_klinik' => $id_klinik, 'nama' => 'Nicholas Lab PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'NICHOLAS LABORATORIES INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVAPHARIN'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVARTIS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'Novartis Indonesia PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVEL'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVELL PHARMACEUTICAL LAB'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVELL PHARMACEUTICAL LAB.'],
            ['id_klinik' => $id_klinik, 'nama' => 'NOVELL PHARMACEUTICAL LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'NUFARINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'NULAB PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NUTRICA'],
            ['id_klinik' => $id_klinik, 'nama' => 'NUTRIFOOD'],
            ['id_klinik' => $id_klinik, 'nama' => 'OHAWE INDONESIA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'OM'],
            ['id_klinik' => $id_klinik, 'nama' => 'OMRON'],
            ['id_klinik' => $id_klinik, 'nama' => 'ONEMED'],
            ['id_klinik' => $id_klinik, 'nama' => 'ORGANON PHARMA INDONESIA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'ORGANON PHARMA INDONESIA TBK - Indonesia'],
            ['id_klinik' => $id_klinik, 'nama' => 'OTSUKA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'OTTO PHARMACEUTICAL INDUSTRIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PAMPERINDO PRIMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PARAGON TECHNOLOGY'],
            ['id_klinik' => $id_klinik, 'nama' => 'PARAGON TECHNOLOGY AND INNOVATION, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PERTIWI AGUNG'],
            ['id_klinik' => $id_klinik, 'nama' => 'PFIZER INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHAPROS Tbk'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHAPROS_Tbk'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHARMA HEALTH CARE'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHARMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHAROS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHAROS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PHARROS Tbk PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PIM'],
            ['id_klinik' => $id_klinik, 'nama' => 'PIM PHARMACEUTICALS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PRATAPA NIRMALA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PRIMA MEDIKA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PROCTER n GAMBLE'],
            ['id_klinik' => $id_klinik, 'nama' => 'PROMEDRAHARDJO FARMASI INDUSTRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'PROMEDRAHARDJO FARMASI PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ABBOT INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ACTAVIS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ACTAVIS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ADITAMARAYA FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT AFW FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ARMOXINDO FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT AVENTIS PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT BAYER'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT BAYER INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT BEIERSDORF INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT BERNOFARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT BOEHRINGER INGELHEIM INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT COMBIPHAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT Corsa Industries'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT DANKOS FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT DARYA VARIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT DARYA VARIA LABORATORIA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT DEXA MEDICA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT DIPA PHARMALAB INTERSAINS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT EAGLE INDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT EAGLE INDO PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT Gallenium Pharmasia Laboratories'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT GENERO PHARMACEUTICALS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT GLAXO WELLCOME INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT GRACIA PHARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT HENSON FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT HISAMITSU PHARMA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT IFARS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT IKAPHARMINDO PUTRAMAS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT IMEDCO DJAJA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT Inasentra Unisatya'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT INDOCARE CITRAPASIFIC'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT INDUSTRI JAMU DAN FARMASI SIDO MUNCUL TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT INTERBAT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KALBE BLACKMORES NUTRITION'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KALBE FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KASA HUSADA WIRA JATIM'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KEMBANG BULAN'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KIMIA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KIMIA FARMA (PERSERO), TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KONIMEX'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT LAPI LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MEDIFARMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MEDIKON PRIMA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MENARINI INDRIA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MEPROFARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MERCK INDONESIA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MIDIX GRAHA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT NICHOLAS LABORATORIES INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT NOVELL PHARMACEUTICAL LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT NUTRICIA MEDICAL NUTRITION'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PERDANA SAKTI INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PERSEROAN DAGANG DAN INDUSTRI FARMASI AFIAT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PERTIWI AGUNG'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PFIZER'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PHAPROS TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PHAROS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT PYRIDAM'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SANBE FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SARI ENESIS INDAH'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SERVIER INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SIMEX PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SINDE BUDI SENTOSA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SOHO INDUSTRI PHARMASI'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SUPRA FERBINDO FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SUPRA FERMINDO FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT TAISHO PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT TEMPO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT TEMPO SCAN PACIFIC TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT TEMPO SCAN PASIFIC'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT TROPICA MAS PHARMACEUTICALS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ULTRA SAKTI'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT VICTORIA CARE INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT VITABIOTICS HEALTHCARE'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ABBOT'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ABBOTT PRODUCTS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT ADITAMARAYA FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT AMAN JAYA SENTOSA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT CORONET CROWN'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT FETIH FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT GRATIA HUSADA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT HJ PHARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT IKAPHARMINDO PUTRAMAS'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT KIMIA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT Landson Pharmaceutical'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT Mahakam Beta Farma'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT MFCS FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SEJATI FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SMJ FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SOFTEX INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'PT SUMBER MAKMUR JAYA FARMINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'PYRIDAM FARMA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'RAFAEL SALGADO, SPAIN'],
            ['id_klinik' => $id_klinik, 'nama' => 'RAMA EMERALD MULTI SUKSES'],
            ['id_klinik' => $id_klinik, 'nama' => 'RECKITT'],
            ['id_klinik' => $id_klinik, 'nama' => 'RECKITT BENCKISER'],
            ['id_klinik' => $id_klinik, 'nama' => 'Rizal'],
            ['id_klinik' => $id_klinik, 'nama' => 'ROHTO LABORATORIES INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'RUDYSOETADI'],
            ['id_klinik' => $id_klinik, 'nama' => 'SAKA UTAMA MEDIKA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'SAMCO FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SAMI MANDJOER'],
            ['id_klinik' => $id_klinik, 'nama' => 'SAMPHARINDO PERDANA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SANBE'],
            ['id_klinik' => $id_klinik, 'nama' => 'SANBE FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SANBE FARMA - Indonesia - -'],
            ['id_klinik' => $id_klinik, 'nama' => 'SANBE FARMA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'SAPTA SARI TAMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SARAKAMANDIRI SEMESTA, PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'SARI ENESIS'],
            ['id_klinik' => $id_klinik, 'nama' => 'SARI HUSADA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SARI MADU UTAMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SARIAYU MARTHATILAAR'],
            ['id_klinik' => $id_klinik, 'nama' => 'SC JOHNSON AND SON'],
            ['id_klinik' => $id_klinik, 'nama' => 'SDM'],
            ['id_klinik' => $id_klinik, 'nama' => 'SELAMAT MAKMUR'],
            ['id_klinik' => $id_klinik, 'nama' => 'SHANGHAI PERKASA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SHANGHIANG PERKASA'],
            ['id_klinik' => $id_klinik, 'nama' => 'Sido Muncul'],
            ['id_klinik' => $id_klinik, 'nama' => 'SIDOMUNCUL'],
            ['id_klinik' => $id_klinik, 'nama' => 'SIMEX'],
            ['id_klinik' => $id_klinik, 'nama' => 'SIMEX PHARMACEUTICAL'],
            ['id_klinik' => $id_klinik, 'nama' => 'SIMEX PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SINAR SURYA CALLISTA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SINDE B'],
            ['id_klinik' => $id_klinik, 'nama' => 'SMITH KLINE BEECHAM PHARMACEUTICAL IND.'],
            ['id_klinik' => $id_klinik, 'nama' => 'SOHO'],
            ['id_klinik' => $id_klinik, 'nama' => 'Soho Global Health PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'SOHO INDUSTRI'],
            ['id_klinik' => $id_klinik, 'nama' => 'SOHO INDUSTRI PHARMASI'],
            ['id_klinik' => $id_klinik, 'nama' => 'SOLAS LANGGENG SEJAHTERA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SOLUSKY'],
            ['id_klinik' => $id_klinik, 'nama' => 'STERLING PRODUCTS INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SUNTHI SEPURI'],
            ['id_klinik' => $id_klinik, 'nama' => 'SURYA DERMATO MEDICA'],
            ['id_klinik' => $id_klinik, 'nama' => 'SURYA DERMATO MEDICA LAB'],
            ['id_klinik' => $id_klinik, 'nama' => 'SURYA DERMATO MEDICA LABORATORIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'SYDNA FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAISHO'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAISHO PHARMACEUTICAL INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAISHO PHARMACEUTICAL LABS'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAISO PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAKEDA INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TAKEDA PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'TANABE INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TARUNAKUSUMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TARUNAKUSUMA PURINUSA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TEMPO'],
            ['id_klinik' => $id_klinik, 'nama' => 'TEMPO NAGADI'],
            ['id_klinik' => $id_klinik, 'nama' => 'TEMPO SCAN P'],
            ['id_klinik' => $id_klinik, 'nama' => 'TEMPO SCAN PACIFIC Tbk'],
            ['id_klinik' => $id_klinik, 'nama' => 'TONNINDO ERAMULYA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TRIJAYA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TRIJAYA SINDO'],
            ['id_klinik' => $id_klinik, 'nama' => 'TRIMAN'],
            ['id_klinik' => $id_klinik, 'nama' => 'TRIYASA NAGAMAS FARMA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TROPICA'],
            ['id_klinik' => $id_klinik, 'nama' => 'TUNGGAL IDAMAN ABDI'],
            ['id_klinik' => $id_klinik, 'nama' => 'TUNGGAL IDAMAN ABDI PT'],
            ['id_klinik' => $id_klinik, 'nama' => 'UD RACHMA SARI'],
            ['id_klinik' => $id_klinik, 'nama' => 'UD. HIPTA NIAGA'],
            ['id_klinik' => $id_klinik, 'nama' => 'ULTRA SAKTI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ULTRAJAYA MILK INDUSTRY'],
            ['id_klinik' => $id_klinik, 'nama' => 'ULTRASAKTI'],
            ['id_klinik' => $id_klinik, 'nama' => 'UNILEVER'],
            ['id_klinik' => $id_klinik, 'nama' => 'UNILEVER INDONESIA TBK'],
            ['id_klinik' => $id_klinik, 'nama' => 'UNIVERSAL PHARMACEUTICAL INDUSTRIES'],
            ['id_klinik' => $id_klinik, 'nama' => 'UNZA VITALIS'],
            ['id_klinik' => $id_klinik, 'nama' => 'USAKA SEKAWAN'],
            ['id_klinik' => $id_klinik, 'nama' => 'VITABIOTICS'],
            ['id_klinik' => $id_klinik, 'nama' => 'VITAPHARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'VIVAPHARM'],
            ['id_klinik' => $id_klinik, 'nama' => 'WINGS SURYA'],
            ['id_klinik' => $id_klinik, 'nama' => 'YASULOR INDONESIA'],
            ['id_klinik' => $id_klinik, 'nama' => 'YUPI'],
            ['id_klinik' => $id_klinik, 'nama' => 'ZENITH'],
        ];
        try {
            foreach ($pabriks as $pabrik) {
                $existingData = DB::table('pabrik')
                    ->where('id_klinik', $pabrik['id_klinik'])
                    ->where('nama', $pabrik['nama'])
                    ->first();
                    
                if (!$existingData) {

                    $lastPabrik = Pabrik::where('id_klinik', $pabrik['id_klinik'])->orderBy('id', 'desc')->first();

                    if ($lastPabrik) {
                        $lastKodePabrik = $lastPabrik->kode;
                        $kodePabrikNumber = (int)substr($lastKodePabrik, 3);
                        $kodePabrikNumber++;
                        $newKodePabrik = 'PBR' . str_pad($kodePabrikNumber, 4, '0', STR_PAD_LEFT);
                    } else {
                        $newKodePabrik = 'PBR0001';
                    }
                    $pabrik['kode'] = $newKodePabrik;
                    $pabrik['created_at'] = $current_time;
                    $pabrik['updated_at'] = $current_time;
                    DB::table('pabrik')->insert($pabrik);
                }
            }
            return response()->json(['success' => 'Data baru berhasil ditambahkan dari Preset.']);
        } catch (\Throwable $th) {
            return response()->json([
                'error' => [$th->getMessage()]
            ], 500);
        }
    }

    public function data()
    {
        $idklinik = auth()->user()->id_klinik;
        $pabrik = Pabrik::where('pabrik.id_klinik', $idklinik)
                    ->orderBy('pabrik.id', 'asc')->get();

        return Datatables::of($pabrik)
            ->addIndexColumn()
            ->addColumn('action', function($pabrik){
                return '
                <div class="action-buttons">
                    <center>
                        <button onClick="editFormPabrik(`'. route('pabrik.update', $pabrik->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-warning pl-2 pr-2" data-toggle="tooltip" title="Edit"><i class="fa fa-edit text-xs"></i></button>
                        <button onClick="deleteDataPabrik(`'. route('pabrik.update', $pabrik->id) . '`)" class="btn btn-xs btn-default btn-rounded rounded-lg text-danger pl-2 pr-2" data-toggle="tooltip" title="Delete"><i class="fa fa-trash text-xs"></i></button>
                    </center>
                </div>
                ';
            })
            ->rawColumns(['status_aktif', 'action'])
            ->make(true);

        return view('master.pabrik.index', compact('idklinik'));
    }

    public function store(Request $request)
    {
        $idklinik = auth()->user()->id_klinik;
        $nama = $request->nama;
        $lastPabrik = Pabrik::where('id_klinik', $idklinik)->orderBy('id', 'desc')->first();

        if ($lastPabrik) {
            $lastKodePabrik = $lastPabrik->kode;
            $kodePabrikNumber = (int)substr($lastKodePabrik, 3);
            $kodePabrikNumber++;
            $newKodePabrik = 'PBR' . str_pad($kodePabrikNumber, 4, '0', STR_PAD_LEFT);
        } else {
            $newKodePabrik = 'PBR0001';
        }

        $request->merge(['kode' => $newKodePabrik]);

        $validator = Validator::make($request->all(), [
            'kode' => 'required',
            'nama' => [
                'required',
                'max:100',
                Rule::unique('pabrik')->where(function ($query) use ($idklinik, $nama) {
                    return $query->where('id_klinik', $idklinik)
                                 ->where('nama', $nama);
                }),
            ],
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|max:100',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_hp' => 'nullable|max:30',
            'rekening' => 'nullable|max:30',
            'npwp' => 'nullable|max:35',
        ], 
        [
            'kode.required' => 'Kode harus diisi.',
            'nama.required' => 'Nama Pabrik harus diisi.',
            'nama.unique' => 'Nama Pabrik sudah digunakan.',
            'nama.max' => 'Maksimal jumlah karakter untuk Nama Pabrik adalah 100 digit.',
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
            'rekening.max' => 'Maksimal jumlah karakter untuk Nomor Rekening adalah 30 karakter.',
            'npwp.max' => 'Maksimal jumlah karakter untuk NPWP adalah 35 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        try {
            $pabrik = new Pabrik();
            $pabrik->id_klinik = $idklinik;
            $pabrik->kode = $request->kode;
            $pabrik->nama = $request->nama;
            $pabrik->alamat = $request->alamat;
            $pabrik->kota = $request->kota;
            $pabrik->telepon = $request->telepon;
            $pabrik->no_hp = $request->no_hp;
            $pabrik->email = $request->email;
            $pabrik->rekening = $request->rekening;
            $pabrik->npwp = $request->npwp;
            $pabrik->status_aktif = $request->status_aktif;

            $pabrik->save();

            return response()->json(['success' => 'Data baru berhasil disimpan.']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => [$e->getMessage()] 
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $pabrik = Pabrik::findOrFail($id);
        $idklinik = auth()->user()->id_klinik;
        $namaLama = $pabrik->nama;
        $namaBaru = $request->nama;

        if ($namaLama != $namaBaru) {
            $validasiNama = Validator::make($request->all(), [
                'nama' => [
                    'required',
                    'max:100',
                    Rule::unique('pabrik')->where(function ($query) use ($idklinik, $namaBaru) {
                        return $query->where('id_klinik', $idklinik)
                                     ->where('nama', $namaBaru);
                    }),
                ],
            ], [
                'nama.required' => 'Nama Pabrik harus diisi.',
                'nama.unique' => 'Nama Pabrik sudah digunakan.',
                'nama.max' => 'Maksimal jumlah karakter untuk Nama Pabrik adalah 100 digit.',
            ]);

            if ($validasiNama->fails()) {
                return response()->json([
                    'error' => $validasiNama->errors()->all()
                ], 422);
            }
        }

        $validator = Validator::make($request->all(), [
            'alamat' => 'nullable|max:255',
            'email' => 'nullable|max:100',
            'kota' => 'nullable|max:100',
            'telepon' => 'nullable|max:20',
            'no_hp' => 'nullable|max:30',
            'rekening' => 'nullable|max:30',
            'npwp' => 'nullable|max:35',
        ], 
        [
            'alamat.max' => 'Maksimal jumlah karakter untuk Alamat adalah 255 karakter.',
            'email.max' => 'Maksimal jumlah karakter untuk Email adalah 100 karakter.',
            'kota.max' => 'Maksimal jumlah karakter untuk Kota adalah 100 karakter.',
            'telepon.max' => 'Maksimal jumlah karakter untuk Nomor Telepon adalah 20 karakter.',
            'no_hp.max' => 'Maksimal jumlah karakter untuk Nomor Handphone adalah 30 karakter.',
            'rekening.max' => 'Maksimal jumlah karakter untuk Nomor Rekening adalah 30 karakter.',
            'npwp.max' => 'Maksimal jumlah karakter untuk NPWP adalah 35 karakter.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => $validator->errors()->all()
            ], 422);
        }

        $pabrik->nama = $namaBaru;
        $pabrik->alamat = $request->alamat;
        $pabrik->kota = $request->kota;
        $pabrik->telepon = $request->telepon;
        $pabrik->no_hp = $request->no_hp;
        $pabrik->email = $request->email;
        $pabrik->rekening = $request->rekening;
        $pabrik->npwp = $request->npwp;
        $pabrik->status_aktif = $request->status_aktif;

        $pabrik->update();

        return response()->json(['success' => 'Data berhasil diperbaharui'], 200);
    }

    public function show($id)
    {
        $pabrik = Pabrik::find($id);
        return response()->json($pabrik);
    }
    
    public function destroy($id)
    {
        Pabrik::find($id)->delete();
      
        return response()->json(['success'=>'Pabrik deleted successfully.']);
    }

}
