while getopts 'lrv' opt; do
  case $opt in
    l)
      HOST='rachel_local';
      ;;
    r)
      HOST='rachel_remote';
      ;;
    v)
      status=`vagrant status | grep test | grep running`;
      if [[ -z $status ]]; then
        vagrant up test
      fi
      HOST='vlocal';
      ;;
  esac
done

if [[ -z $HOST ]]; then
  echo -e 'ERROR:\tmust specify either local (-l), remote (-r) or virtual (-v)';
else
  scp -r ./* $HOST:/var/www/comics
fi
