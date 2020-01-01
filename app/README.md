require_once 'vendor/autoload.php';

$input = json_decode('{
    "male": {
        "1": ["2", "4", "6", "8"],
        "3": ["4", "6", "8", "2"],
        "5": ["6", "8", "2", "4"],
        "7": ["8", "2", "4", "6"]
    },
    "female":{
        "2": ["1", "3", "5", "7"],
        "4": ["3", "5", "7", "1"],
        "6": ["5", "7", "1", "3"],
        "8": ["7", "1", "3", "5"]
    }
}');
$client = xVolveTest::client("YOUR_API_KEY");
$algo = $client->algo("matching/StableMarriageAlgorithm/0.1.1");
$algo->setOptions(["timeout" => 300]); //optional
print_r($algo->pipe($input)->result);

---

import java.io.BufferedReader;
import java.io.DataInputStream;
import java.io.FileInputStream;
import java.io.InputStreamReader;

public class GaleShapley
{
private int N, engagedCount;
private String[][] menPref;
private String[][] womenPref;
private String[] men;
private String[] women;
private String[] womenPartner;
private boolean[] menEngaged;

/** Constructor **/
public GaleShapley(String[] m, String[] w, String[][] mp, String[][] wp)
{
    N = mp.length;
    engagedCount = 0;
    men = m;
    women = w;
    menPref = mp;
    womenPref = wp;
    menEngaged = new boolean[N];
    womenPartner = new String[N];
    calcMatches();
}
/** function to calculate all matches **/
private void calcMatches()
{
    while (engagedCount < N)
    {
        int free;
        for (free = 0; free < N; free++)
            if (!menEngaged[free])
                break;

        for (int i = 0; i < N && !menEngaged[free]; i++)
        {
            int index = womenIndexOf(menPref[free][i]);
            if (womenPartner[index] == null)
            {
                womenPartner[index] = men[free];
                menEngaged[free] = true;
                engagedCount++;
            }
            else
            {
                String currentPartner = womenPartner[index];
                if (morePreference(currentPartner, men[free], index))
                {
                    womenPartner[index] = men[free];
                    menEngaged[free] = true;
                    menEngaged[menIndexOf(currentPartner)] = false;

                }
            }
        }            
    }
    printCouples();
}
/** function to check if women prefers new partner over old assigned partner **/
private boolean morePreference(String curPartner, String newPartner, int index)
{
    for (int i = 0; i < N; i++)
    {
        if (womenPref[index][i].equals(newPartner))
            return true;
        if (womenPref[index][i].equals(curPartner))
            return false;
    }
    return false;
}
/** get men index **/
private int menIndexOf(String str)
{
    for (int i = 0; i < N; i++)
        if (men[i].equals(str))
            return i;
    return -1;
}
/** get women index **/
private int womenIndexOf(String str)
{
    for (int i = 0; i < N; i++)
        if (women[i].equals(str))
            return i;
    return -1;
}
/** print couples **/
public void printCouples()
{
    System.out.println("Couples are : ");
    for (int i = 0; i < N; i++)
    {
        System.out.println(womenPartner[i] +" "+ women[i]);
    }
}
/** main function **/
public static void main(String[] args) 
{
    System.out.println("Gale Shapley Marriage Algorithm\n");
    /** list of men **/
    String[] m = {"1", "2", "3"};
    /** list of women **/
    String[] w = {"1", "2", "3"};

    /** men preference **/
    String[][] mp = null ;
    /** women preference **/                      
    String[][] wp= null ;

 // Input.txt is like
 // 3 <--defines the size of array
 // male preference array
 // 1 3 2
 // 1 2 3
 // 2 3 1

//female preference array
//1 3 2
//2 1 3
//2 1 3


    try{
      FileInputStream fstream = new FileInputStream("input.txt");
      DataInputStream in = new DataInputStream(fstream);
      BufferedReader br = new BufferedReader(new InputStreamReader(in));
      String strLine;
      int line=0;
      int k=0;
      int n=0;
      int i=0;
      while ((strLine = br.readLine()) != null) {
         if(line==0){
            n =Integer.valueOf(strLine);
            mp=new String[n][n];
            wp=new String[n][n];
            line++;
         }
         else{

             String[] preferences=strLine.split(" ");

             if(i<n){
                 mp[i]=preferences;
             }
             else{
                 wp[i-n]=preferences;
             }
             i++;
         }
      }
      in.close();

        }catch (Exception e){//Catch exception if any
              System.err.println("Error: " + e.getMessage());
        }
    GaleShapley gs = new GaleShapley(m, w, mp, wp);                        
   }
  }
